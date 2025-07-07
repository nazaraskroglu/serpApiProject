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
        return view('serp.api_form_check');
    }

    public function check(SerpApiRequest $request) {
        try {
            $validatedData = $request->validated();
            $rank = $this->service->getRank($validatedData);
            return view('serp.api_form_check', ['domain'  => $validatedData['domain'], 'keyword' => $validatedData['keyword'], 'rank' => $rank]);
        } catch (\Exception $e) {
            return back()->withErrors(['api' => 'Bir hata oluştu: ' . $e->getMessage()])->withInput();
        }
    }


}
