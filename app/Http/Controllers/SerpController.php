<?php

namespace App\Http\Controllers;

use App\Http\Requests\SerpApiRequest;
use App\Services\SerpApiService;

class SerpController extends Controller
{
    private $service;

    public function __construct(SerpApiService $service) {
        $this->service = $service;
    }

    public function index() {
        return view('serp_api_check');
    }

    public function check(SerpApiRequest $request) {
        try {
            $validatedData = $request->validated();
            $rank = $this->service->getRank($validatedData); // Doğrulanmış veri ile sıralama bilgisi alınır.
            return response()->json(['rank' => $rank]);
        } catch (\Exception $e) {
            return back()->withErrors(['api' => 'Bir hata oluştu: ' . $e->getMessage()])->withInput();
        }
    }

}
