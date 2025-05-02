<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Country;
use App\Models\City;
use Illuminate\Support\Facades\Http;

class CountriesCitiesNowControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testApiToCountriesAndCities()
    {
        Http::fake([
            'https://countriesnow.space/api/v0.1/countries' => Http::response([
                'data' => [
                    [
                        'country' => 'Tesztország',
                        'iso2' => 'TZ',
                        'iso3' => 'TZZ',
                        'cities' => ['Tesztváros 1', 'Tesztváros 2'],
                    ]
                ]
            ], 200)
        ]);

        $response = $this->post('/api/countries/import');

        $response->assertStatus(200);
        $this->assertDatabaseHas('countries', ['name' => 'Tesztország']);
        $this->assertDatabaseHas('cities', ['name' => 'Tesztváros 1']);
        $this->assertDatabaseHas('cities', ['name' => 'Tesztváros 2']);
    }
}

