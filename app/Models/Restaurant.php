<?php

namespace App\Models;

use App\Models\RestaurantLikes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'streetAddress',
        'city',
        'state',
        'cuisineType',
        'rating',
        'startWorkingTime',
        'finishWorkingTime',
        'imageUrl',
        'logoUrl',
        'tags',
        'coords_id',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function menuCategories()
    {
        return $this->hasMany(MenuCategory::class);
    }
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'restaurant_likes');
    }
}
