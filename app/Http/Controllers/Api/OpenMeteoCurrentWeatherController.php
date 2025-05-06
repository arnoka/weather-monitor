<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CurrentWeather;
use App\Models\WeatherQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenMeteoCurrentWeatherController extends Controller
{
    protected $openMeteoGetCityDataController;

    public function __construct(OpenMeteoGetCityDataController $openMeteoGetCityDataController) {
        $this->openMeteoGetCityDataController = $openMeteoGetCityDataController;
    }

    public function getWeather(int $cityId)
    {
        $openData = $this->openMeteoGetCityDataController->getCity($cityId);

        $response = Http::get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $openData['results'][0]['latitude'],
            'longitude' => $openData['results'][0]['longitude'],
            'current_weather' => true,
        ]);
   
        if (!$response->ok()) {
            return response()->json(['error' => 'Nem sikerült a külső API lekérése.'], 500);
        }

        $weatherData = $response['current_weather'];

        $currentWeather = CurrentWeather::create([
            'time' => strtotime($weatherData['time']),
            'temperature' => $weatherData['temperature'],
        ]);

        $currentWeather->weatherQuery()->create([
            'latitude' => $openData['results'][0]['latitude'],
            'longitude' => $openData['results'][0]['longitude'],
            'generationtime_ms' => 0,
            'utc_offset_seconds' => 0,
            'timezone' => $response['timezone'] ?? 'GMT',
            'timezone_abbreviation' => $response['timezone_abbreviation'] ?? 'GMT',
            'elevation' => $response['elevation'] ?? 0,
            'city_id' => $cityId,
        ]);

        return $currentWeather;

    }
}
