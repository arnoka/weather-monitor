<?php

use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\CountriesCitiesNowController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\OpenMeteoCurrentWeatherController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\WeatherHistoryController;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/countries/import', [CountriesCitiesNowController::class, 'store']);

Route::post('/open-meteo-current-weather', [OpenMeteoCurrentWeatherController::class, 'getWeather']);

Route::post('/save-settings', [SettingsController::class, 'store']);

Route::get('/settings', [SettingsController::class, 'load']);

Route::get('/weather/history-all', [WeatherHistoryController::class, 'all']);

Route::get('/countries', [CountryController::class, 'index']);

Route::get('/countries/{country}/cities', [CountryController::class, 'cities']);

Route::get('/all-cities', [CityController::class, 'all']);

