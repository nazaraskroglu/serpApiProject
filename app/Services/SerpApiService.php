<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SerpApiService extends BaseService{

    protected $url, $key;
    protected $timezoneCountryMap = [
        'Europe/Istanbul' => ['gl' => 'tr', 'hl' => 'tr'],
        'Europe/London' => ['gl' => 'uk', 'hl' => 'en'],
        'Europe/Berlin' => ['gl' => 'de', 'hl' => 'de'],
        'America/New_York' => ['gl' => 'us', 'hl' => 'en'],
        'Asia/Tokyo' => ['gl' => 'jp', 'hl' => 'ja'],
    ];

    public function __construct()
    {
        $this->url = config('services.serpapi.url');
        $this->key = config('services.serpapi.key');
    }

    public function getRank(array $data): ?int
    {
        $domain = parse_url($data['domain'], PHP_URL_HOST);
        $keyword = $data['keyword'];
        $start = 0;
        $maxTries = 5; // maksimum 5 sayfa (50 sonuç)
        $tries = 0;
        $startTime = now();
        $maxDuration = 15; // saniye bazında işlem süresi sınırı

        $timezone = $data['timezone'] ?? 'Europe/Istanbul';
        $regionInfo = $this->timezoneCountryMap[$timezone] ?? ['gl' => 'tr', 'hl' => 'tr'];
        $gl = $regionInfo['gl'];
        $hl = $regionInfo['hl'];


        while ($start <= 90) {
            if ($tries >= $maxTries || now()->diffInSeconds($startTime) > $maxDuration) {
                break; // Çok uzun sürdüğünde döngüyü sonlandır.
            }
            $response = Http::timeout(10)->get($this->url . '/search', [
                'engine' => 'google',
                'q' => $keyword,
                'google_domain' => 'google.com',
                'gl' => $gl,
                'hl' => $hl,
                'api_key' => $this->key,
                'start' => $start,
            ]);

            if (!$response->successful()) {
                throw new \Exception('SERP API isteği başarısız. Durum: ' . $response->status());
            }

            $organicResults = $response->json('organic_results') ?? [];
            foreach ($organicResults as $result) {
                if (isset($result['displayed_link']) && str_contains($result['displayed_link'], $domain)) {
                    return $result['position'];
                }
            }
            $start += 10;
            $tries++;
        }
        return null; // sonuç bulunamadı
    }


}
