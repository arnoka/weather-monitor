<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherQuery extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'latitude',
        'longitude',
        'generationtime_ms',
        'utc_offset_seconds',
        'timezone',
        'timezone_abbreviation',
        'elevation',
    ];

    public function queryable(): MorphTo
{
    return $this->morphTo();
}
}
