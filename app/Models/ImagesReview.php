<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesReview extends Model
{
    // use HasUuids;
    use HasFactory;

    protected $fillable = [

        'url',
        'review_id',
    ];
    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id', 'id');
    }
}
