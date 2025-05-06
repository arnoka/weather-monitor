<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenMeteoGetCityDataController extends Controller
{
    public function getCity(int $cityId)
    {
        $city = City::find($cityId);

        $response = Http::get('https://geocoding-api.open-meteo.com/v1/search', [
            'name' => $city->name,
        ]);

        if (!$response->ok()) {
            return response()->json(['error' => 'Nem sikerült a külső API lekérése.'], 500);
        }

        $countryCityData = $response->json();

        return $countryCityData;

    }
}
