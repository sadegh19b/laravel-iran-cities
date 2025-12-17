<?php

namespace Sadegh19b\LaravelIranCities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{    
    protected $fillable = [
        'name',
        'province_id',
        'county_id'
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function county(): BelongsTo
    {
        return $this->belongsTo(County::class);
    }
} 