<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use Illuminate\Support\Facades\Http;

class CountriesCitiesNowController extends Controller
{
    public function store()
    {
        if (Country::count() > 0) {
            return response()->json(['message' => 'Az országok már be vannak töltve.'], 200);
        }

        $response = Http::get('https://countriesnow.space/api/v0.1/countries');

        if (!$response->ok()) {
            return response()->json(['error' => 'Nem sikerült a külső API lekérése.'], 500);
        }

        $countryCityData =$response->json()['data'];

        foreach ($countryCityData as $data) {
            $current = Country::create([
                'name' => $data['country'],
                'iso2' => $data['iso2'],
                'iso3' => $data['iso3'],
            ]);

            foreach ($data['cities'] as $city) {
                $newCity = City::create([
                    'name' => $city,
                    'country_id' => $current->id,
                ]);
            }
        }

    }
}
