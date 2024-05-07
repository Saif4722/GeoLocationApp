<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IPGeolocationService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('api.abstract_api_key');
        $this->baseUrl = config('constants.GEOLOCATION_API_BASE_URL');
    }

    public function fetchGeolocation($ipAddress)
    {
        try{
            $url = "{$this->baseUrl}?api_key={$this->apiKey}&ip_address={$ipAddress}";
            $response = Http::get($url);
            
            // Log the API request and response
            \Log::info('API Request:', ['url' => $url]);
            \Log::info('API Response:', $response->json());
            
            if ($response->successful()) {
                return $response->json();
            } else {
                \Log::error('API Request failed:', ['status_code' => $response->status(), 'error' => $response->json()]);
                throw new \Exception('API Request failed.');
            }
        } catch (\Exception $e) {
            \Log::error('Exception:', ['message' => $e->getMessage()]);
            throw new \Exception('Failed to fetch geolocation data.');
        }
    }
}
