<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'cities' => 'required|array',
            'cities.*' => 'integer',
            'value' => 'required|integer'
        ]);

        $setting = Setting::first() ?? new Setting();
        $setting->fill($data);
        $setting->save();

        return response()->json(['message' => 'Beállítás elmentve']);
    }

    public function load()
    {
        $setting = Setting::first();

        return response()->json([
            'cities' => $setting?->cities ?? [],
            'value' => $setting?->value ?? 0,
        ]);
    }
}
