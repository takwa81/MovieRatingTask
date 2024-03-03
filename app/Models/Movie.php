<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $table = 'movies';
    protected $fillable = [
        'title',
        'year' ,
        'genre_id'
    ];

    protected $appends = [
        'rating'
    ];

    public function getRatingAttribute()
    {
        $rating = $this->ratings->avg('rating');
        return $rating ? round($rating, 2) : 0.0;
    }


    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

}
