<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Reads this instance's Website Config data from school-sass's per-school
 * JSON API (Sanctum website_api token). Cache-aside with a short TTL, falling
 * back to the last-known-good response (cached with no expiry) on failure —
 * a school-sass outage degrades to stale content, never a broken page
 * (design doc Engineering Decisions #2/#3). Asset URLs come back as full
 * public URLs already, so they're cached and fall back alongside the rest of
 * the JSON payload with no separate mechanism needed.
 */
class SchoolSassClient
{
    private string $baseUrl;
    private ?string $token;
    private int $ttl;

    public function __construct()
    {
        $this->baseUrl = rtrim(config('services.school_sass.base_url'), '/');
        $this->token = config('services.school_sass.token');
        $this->ttl = (int) config('services.school_sass.cache_ttl', 300);
    }

    public function noticeTypes(): array
    {
        return $this->get('notice-types');
    }

    public function notices(): array
    {
        return $this->get('notices');
    }

    public function management(): array
    {
        return $this->get('management');
    }

    public function faculty(): array
    {
        return $this->get('faculty');
    }

    public function teachers(): array
    {
        return $this->get('teachers');
    }

    public function photoGallery(): array
    {
        return $this->get('photo-gallery');
    }

    public function videoGallery(): array
    {
        return $this->get('video-gallery');
    }

    public function banners(): array
    {
        return $this->get('banners');
    }

    public function menuTree(): array
    {
        return $this->normalizeMenuUris($this->get('menu/tree'));
    }

    /**
     * School-sass's Website Menu admin form doesn't strip slashes from the uri
     * field, so an admin can save "/foo" instead of "foo" — that produces a
     * double-slash (content//foo) 404 once plugged into route(). Trim here so
     * every consumer gets a clean segment.
     */
    private function normalizeMenuUris(array $nodes): array
    {
        foreach ($nodes as &$node) {
            if (isset($node['uri'])) {
                $node['uri'] = trim($node['uri'], '/');
            }
            if (!empty($node['children'])) {
                $node['children'] = $this->normalizeMenuUris($node['children']);
            }
        }
        return $nodes;
    }

    public function content(int $menuId): array
    {
        return $this->get("content/{$menuId}");
    }

    public function stats(): array
    {
        return $this->get('stats');
    }

    public function classes(): array
    {
        return $this->get('classes');
    }

    /**
     * POST /v1/website/pre-admission — relays a public online admission form
     * submission to school-sass, storing it against this school's id.
     *
     * @return array{success: bool, message: string, errors?: array}
     */
    public function submitPreAdmission(array $fields, ?\Illuminate\Http\UploadedFile $photo = null): array
    {
        try {
            $request = Http::withToken($this->token)
                ->acceptJson()
                ->withHeaders(['X-Domain' => request()->getHost()])
                ->timeout(10);

            if ($photo) {
                $request = $request->attach('photo', fopen($photo->getRealPath(), 'r'), $photo->getClientOriginalName());
            }

            $response = $request->post("{$this->baseUrl}/api/v1/website/pre-admission", $fields);

            if ($response->successful()) {
                return ['success' => true, 'message' => $response->json('message', 'Submitted.')];
            }

            Log::warning("SchoolSassClient: pre-admission submit returned HTTP {$response->status()}");

            return [
                'success' => false,
                'message' => $response->json('message', 'Submission failed.'),
                'errors'  => $response->json('errors', []),
            ];
        } catch (\Throwable $e) {
            Log::warning("SchoolSassClient: pre-admission submit failed: {$e->getMessage()}");
            return ['success' => false, 'message' => 'Unable to reach the school server. Please try again later.'];
        }
    }

    /**
     * School's display name, from school-sass's own `schools` table (via /ping,
     * which is {success, school_id, school_name} — not the {data: [...]} shape
     * every other endpoint uses, so it gets its own small cache-aside instead
     * of going through get()).
     */
    public function schoolName(): ?string
    {
        $cacheKey = 'school_sass:school_name';
        $staleKey = $cacheKey . ':stale';

        $fresh = Cache::get($cacheKey);
        if ($fresh !== null) {
            return $fresh;
        }

        try {
            $response = Http::withToken($this->token)
                ->acceptJson()
                ->withHeaders(['X-Domain' => request()->getHost()])
                ->timeout(5)
                ->get("{$this->baseUrl}/api/v1/website/ping");

            if ($response->successful()) {
                $name = $response->json('school_name');
                if ($name) {
                    Cache::put($cacheKey, $name, $this->ttl);
                    Cache::forever($staleKey, $name);
                    return $name;
                }
            }

            Log::warning("SchoolSassClient: ping returned HTTP {$response->status()}");
        } catch (\Throwable $e) {
            Log::warning("SchoolSassClient: ping request failed: {$e->getMessage()}");
        }

        return Cache::get($staleKey);
    }

    /**
     * @return array The 'data' payload for $endpoint, from fresh cache, a live
     *               call, stale cache, or [] if none of those are available.
     */
    private function get(string $endpoint): array
    {
        $cacheKey = $this->cacheKey($endpoint);

        $fresh = Cache::get($cacheKey);
        if ($fresh !== null) {
            return $fresh;
        }

        try {
            $response = Http::withToken($this->token)
                ->acceptJson()
                ->withHeaders(['X-Domain' => request()->getHost()])
                ->timeout(5)
                ->get("{$this->baseUrl}/api/v1/website/{$endpoint}");

            if ($response->successful()) {
                $data = $response->json('data', []);
                Cache::put($cacheKey, $data, $this->ttl);
                Cache::forever($this->staleCacheKey($endpoint), $data);
                return $data;
            }

            Log::warning("SchoolSassClient: {$endpoint} returned HTTP {$response->status()}");
        } catch (\Throwable $e) {
            Log::warning("SchoolSassClient: {$endpoint} request failed: {$e->getMessage()}");
        }

        $stale = Cache::get($this->staleCacheKey($endpoint));
        return $stale ?? [];
    }

    private function cacheKey(string $endpoint): string
    {
        return 'school_sass:' . $endpoint;
    }

    private function staleCacheKey(string $endpoint): string
    {
        return 'school_sass:' . $endpoint . ':stale';
    }
}
