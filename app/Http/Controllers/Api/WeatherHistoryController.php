<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Setting;
use App\Models\WeatherQuery;
use Illuminate\Http\Request;

class WeatherHistoryController extends Controller
{
    public function all()
    {
        $setting = Setting::first();

        if (!$setting || empty($setting->cities)) {
            return response()->json(['error' => 'Nincs beállított város'], 404);
        }

        $result = [];

        foreach ($setting->cities as $cityId) {
            $city = City::find($cityId);
            if (!$city) continue;

            $data = WeatherQuery::where('city_id', $cityId)
            ->with('queryable')
            ->orderBy('created_at', 'desc')
            ->take(1)
            ->get()
            ->map(function ($query) {
                return [
                    'time' => $query->queryable->time ?? null,
                    'temperature' => $query->queryable->temperature ?? null,
                ];
            });

            $result[] = [
                'city' => $city->name,
                'data' => $data,
            ];
        }

        return response()->json($result);
    }
}
