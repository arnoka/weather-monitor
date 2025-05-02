<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphOneOrMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrentWeather extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'time',
        'temperature',
    ];

    public function weatherQuery(): MorphOne
    {
        return $this->morphOne(WeatherQuery::class, 'queryable');
    }
}
