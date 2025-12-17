<?php

namespace Sadegh19b\LaravelIranCities\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $fillable = [
        'name',
        'tel_prefix'
    ];

    public function counties(): HasMany
    {
        return $this->hasMany(County::class);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
} 