<?php

namespace App\Http\Controllers;

use App\Http\Requests\SerpApiRequest;
use App\Services\SerpApiService;
use Illuminate\Validation\ValidationException;

class SerpController extends Controller
{
    private $service;

    public function __construct(SerpApiService $service) {
        $this->service = $service;
    }

    public function index() {
        return view('serp_api_check');
    }

    public function check(SerpApiRequest $request)
    {
        try {
            $validatedData = $request->validated();
            $rank = $this->service->getRank($validatedData);
            return response()->json(['rank' => $rank]);
        } catch (\Exception $e) {
            if ($e instanceof ValidationException) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            return response()->json(['error' => 'Bir hata oluştu: ' . $e->getMessage()], 500);
        }
    }



}
