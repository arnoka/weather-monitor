<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        return Country::select('id', 'name')->orderBy('name')->get();
    }

    public function cities(Country $country)
    {
        return $country->cities()->select('id', 'name')->orderBy('name')->get();
    }
}
