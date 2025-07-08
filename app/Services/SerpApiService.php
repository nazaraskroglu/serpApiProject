<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class SerpApiService extends BaseService{

    protected $client, $url, $key;
    protected $timezoneCountryMap = [ //gelen timezone değerine göre maplama işlemi.
        'Europe/Istanbul' => ['gl' => 'tr', 'hl' => 'tr'],
        'Europe/London' => ['gl' => 'uk', 'hl' => 'en'],
        'Europe/Berlin' => ['gl' => 'de', 'hl' => 'de'],
        'America/New_York' => ['gl' => 'us', 'hl' => 'en'],
        'Asia/Tokyo' => ['gl' => 'jp', 'hl' => 'ja'],
    ];

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.serpapi.url'),
            'timeout'  => 10.0,
        ]);
        $this->url = config('services.serpapi.url');
        $this->key = config('services.serpapi.key');
    }

    public function getRank(array $data): ?int
    {
        $domain = parse_url($data['domain'], PHP_URL_HOST);
        $keyword = $data['keyword'];
        $start = 0; // Google Serp sayfası için başlangıç offset değeri.
        $maxTries = 5; // Maksimum kaç sayfa sorgulanacak
        $tries = 0;  // Kaç kez deneme yapıldığını takip etmek için sayaç
        $maxDuration = 15; // saniye bazında işlem süresi sınırı
        $startTime = now();

        $timezone = $data['timezone'] ?? 'Europe/Istanbul';
        $regionInfo = $this->timezoneCountryMap[$timezone] ?? ['gl' => 'tr', 'hl' => 'tr']; //tarayıcıdan timezone değeri alınır yoksa default tr kabul edilir
        $gl = $regionInfo['gl'];
        $hl = $regionInfo['hl'];

        while ($start <= 90) {
            if ($tries >= $maxTries || now()->diffInSeconds($startTime) > $maxDuration) {
                break; // Çok uzun sürdüğünde döngüyü sonlandırır.
            }
            $response = $this->client->request('GET', '/search', [
                'query' => [
                    'engine'        => 'google',
                    'q'             => $keyword,
                    'google_domain' => 'google.com',
                    'gl'            => $gl,
                    'hl'            => $hl,
                    'api_key'       => $this->key,
                    'start'         => $start,
                ],
            ]);
            if ($response->getStatusCode() !== 200) {
                throw new \Exception('SERP API isteği başarısız. Durum: ' . $response->getStatusCode());
            }
            $data = json_decode($response->getBody()->getContents(), true);

            $organicResults = $data['organic_results'] ?? []; // Sonuçlar içinde domain eşleşmesi aranır
            dd($organicResults);
            foreach ($organicResults as $result) {
                if (isset($result['displayed_link']) && str_contains($result['displayed_link'], $domain)) {
                    return $result['position'];
                }
            }
            $start += 10;
            $tries++;
        }
        return null;
    }


}
