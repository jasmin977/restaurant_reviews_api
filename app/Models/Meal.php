<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Meal extends Model
{

    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'description',
        'price',
        'rating',
        'url',
        'menu_category_id',
    ];
    public function menuCategory()
    {
        return $this->belongsTo(MenuCategory::class, 'menu_category_id', 'id');
    }
}
