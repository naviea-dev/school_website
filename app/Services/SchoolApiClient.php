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
        //dd($this->api);
    }

    /**
     * Common API request
     */
    public function request(string $endpoint)
    {
        try {
            $response = Http::acceptJson()
                ->withHeaders([
                    'X-Domain' => request()->getHost(),
                    //'X-Domain' => 'eduibd.com',
                ])
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
     */
    public function preAdmission(array $data)
    {
        return Http::acceptJson()
            ->withHeaders([
                'X-Domain' => request()->getHost(),
            ])
            ->post($this->api . '/pre-admission', $data);
    }
}
