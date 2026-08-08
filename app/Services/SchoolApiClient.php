<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SchoolApiClient
{
    protected string $api;

    public function __construct()
    {
        $this->api = rtrim(config('services.school_api.url'), '/');
    }

    /**
     * Common API request
     */
    public function request(string $endpoint)
    {
        try {
            $response = Http::acceptJson()
                ->withHeaders(['X-Domain' => request()->getHost()])
                ->timeout(10)
                ->get($this->api . '/' . ltrim($endpoint, '/'));

            $response->throw();

            return json_decode($response->body());
        } catch (\Throwable $e) {
            Log::error('School API Error: ' . $e->getMessage());

            return null;
        }
    }
    /**
     * Contact Form
     */
    public function contact(array $data)
    {
        return Http::acceptJson()
            ->withHeaders([
                'X-Domain' => request()->getHost(),
            ])
            ->post($this->api . '/contact', $data);
    }


    /**
     * Pre Admission Form
     *
     * @return array{success: bool, message: string, errors?: array}
     */
    public function preAdmission(array $fields, ?\Illuminate\Http\UploadedFile $photo = null): array
    {
        try {
            $request = Http::acceptJson()
                ->withHeaders(['X-Domain' => request()->getHost()])
                ->timeout(10);

            if ($photo) {
                $request = $request->attach('photo', fopen($photo->getRealPath(), 'r'), $photo->getClientOriginalName());
            }

            $response = $request->post($this->api . '/pre-admission', $fields);

            if ($response->successful()) {
                return ['success' => true, 'message' => $response->json('message', 'Submitted.')];
            }

            Log::warning("School API: pre-admission submit returned HTTP {$response->status()}");

            return [
                'success' => false,
                'message' => $response->json('message', 'Submission failed.'),
                'errors'  => $response->json('errors', []),
            ];
        } catch (\Throwable $e) {
            Log::error('School API Error: ' . $e->getMessage());
            return ['success' => false, 'message' => 'Unable to reach the school server. Please try again later.'];
        }
    }
}
