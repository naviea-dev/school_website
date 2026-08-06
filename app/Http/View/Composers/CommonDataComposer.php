<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use App\Services\SchoolApiClient;

class CommonDataComposer
{
    protected array $commonData;

    public function __construct(SchoolApiClient $apiService)
    {
        $domain = request()->getHost();


        $this->commonData = Cache::remember(
            'website_common_' . $domain,
            now()->addMinutes(60),
            function () use ($apiService) {

                $response = $apiService->request('common');

                if (!$response) {
                    return [
                        'school_name' => 'EduiBD',
                        'logo' => null,
                        'school_tag' => 'We provide a supportive learning environment where students develop academic excellence, creativity, confidence, and essential skills to succeed in a global society.',
                        'school' => null,
                        'menus' => [],
                        'footer_menus' => [],
                        'footer' => [],
                    ];
                }

                return $this->formatData($response);
            }
        );
    }


    private function formatData($data): array
    {
        return [
            'school_name' => $data->data->school->name ?? 'EduiBD',
            'logo' => $data->data->school->logo ?? null,
            'school_tag' => 'We provide a supportive learning environment where students develop academic excellence, creativity, confidence, and essential skills to succeed in a global society.',
            'school' => $data->data->school ?? null,
            'menus' => $this->buildMenuTree(
                $data->data->menus ?? []
            ),

            'footer_menus' => $this->buildMenuTree(
                $data->data->menus ?? []
            ),
            'footer' => $data->data->footer ?? [],
        ];
    }


    private function buildMenuTree($nodes)
    {
        return collect($nodes)->map(function ($node) {

            $node = (object) $node;

            $node->subMenu = collect($node->children ?? [])
                ->map(function ($child) {

                    $child = (object) $child;

                    $child->lastMenu = collect($child->children ?? [])
                        ->map(fn($item) => (object) $item);

                    return $child;
                });

            return $node;
        });
    }


    public function compose(View $view)
    {
        $view->with('commonData', $this->commonData);
    }
}
