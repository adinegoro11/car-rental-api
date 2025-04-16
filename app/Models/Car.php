<?php

namespace App\Models;

use App\Builders\CarBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Car extends Model
{
    /** @use HasFactory<\Database\Factories\CarFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'day_rate',
        'month_rate',
        'image_url',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    // public function newEloquentBuilder($query): CarBuilder
    // {
    //     return new CarBuilder($query);
    // }
}
