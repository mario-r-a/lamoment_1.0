<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleRoutesService
{
    protected $apiKey;
    protected $baseUrl = 'https://routes.googleapis.com/directions/v2:computeRoutes';

    public function __construct()
    {
        $this->apiKey = config('services.google.maps_api_key');
        
        if (!$this->apiKey) {
            throw new \Exception('Google Maps API Key tidak ditemukan di .env');
        }
    }

    /**
     * Hitung tarif tol dari origin ke destination
     *
     * @param string $origin Alamat asal (misal: "Monas, Jakarta")
     * @param string $destination Alamat tujuan (misal: "Gedung Sate, Bandung")
     * @return array Response dengan format: ['success' => bool, 'data' => array|null, 'message' => string]
     */
    public function getTollPrice(string $origin, string $destination): array
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => 'routes.distanceMeters,routes.duration,routes.polyline,routes.travelAdvisory.tollInfo',
            ])->post($this->baseUrl, [
                'origin' => ['address' => $origin],
                'destination' => ['address' => $destination],
                'travelMode' => 'DRIVE',
                'extraComputations' => ['TOLLS'],
                'routingPreference' => 'TRAFFIC_AWARE',
            ]);

            // Log response untuk debugging (optional, hapus di production)
            Log::info('Google Routes API Response', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            // Cek apakah request berhasil (status 200)
            if (!$response->successful()) {
                return [
                    'success' => false,
                    'data' => null,
                    'message' => 'API error: ' . $response->status() . ' - ' . $response->body(),
                ];
            }

            $data = $response->json();

            // Cek apakah ada route di response
            if (empty($data['routes'])) {
                return [
                    'success' => false,
                    'data' => null,
                    'message' => 'Tidak ada rute ditemukan untuk alamat tersebut.',
                ];
            }

            $route = $data['routes'][0];

            // Extract data yang kita butuhkan
            $distance = $route['distanceMeters'] ?? null;
            $duration = $route['duration'] ?? null;
            $tollUnits = $route['travelAdvisory']['tollInfo']['estimatedPrice'][0]['units'] ?? null;
            $tollNanos = $route['travelAdvisory']['tollInfo']['estimatedPrice'][0]['nanos'] ?? 0;
            $currency = $route['travelAdvisory']['tollInfo']['estimatedPrice'][0]['currencyCode'] ?? 'IDR';

            // Hitung total toll price (units + nanos/1,000,000,000)
            $tollPrice = $tollUnits !== null ? (float)$tollUnits + ($tollNanos / 1000000000) : null;

            // Kalau tarif tol nggak ada (misal: rute tanpa tol atau data belum tersedia)
            if (!$tollPrice) {
                return [
                    'success' => true,
                    'data' => [
                        'distance' => $distance,
                        'duration' => $duration,
                        'toll_price' => null,
                        'currency' => $currency,
                    ],
                    'message' => 'Tarif tol belum tersedia untuk rute ini (mungkin rute tanpa tol atau data Google belum lengkap).',
                ];
            }

            return [
                'success' => true,
                'data' => [
                    'distance' => $distance,
                    'duration' => $duration,
                    'toll_price' => $tollPrice,
                    'currency' => $currency,
                ],
                'message' => 'Berhasil mendapatkan data tarif tol.',
            ];

        } catch (\Exception $e) {
            Log::error('Google Routes API Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ];
        }
    }
}