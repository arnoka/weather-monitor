<?php

namespace App\Console\Commands;

use App\Http\Controllers\Api\OpenMeteoCurrentWeatherController;
use App\Http\Controllers\Api\OpenMeteoGetCityDataController;
use App\Models\City;
use App\Models\Setting;
use App\Models\WeatherQuery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchWeatherData extends Command
{

    protected $signature = 'weather:fetch';
    protected $description = 'Lekérdezi az aktuális időjárási adatokat a beállított városokhoz';

    /**
     * Execute the console command.
     */
    public function handle(OpenMeteoCurrentWeatherController $currentWeather)
    {
        $setting = Setting::first();
        if (!$setting) {
            $this->error('Nincsenek beállított városok.');
            return 1;
        }

        foreach ($setting->cities as $cityId) {
            $city = City::find($cityId);
            if (!$city) continue;
            $currentWeather->getWeather($cityId);       
        }

        $this->info('Lekérdezés sikeres volt.');
        return 0;
    }
}
