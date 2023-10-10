<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coords extends Model
{
    // use HasUuids;
    use HasFactory;
    protected $fillable = [
        'latitude',
        'longitude',
        'restaurant_id',

    ];

    public function coord()
    {
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }
}
