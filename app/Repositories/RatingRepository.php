<?php

namespace App\Repositories;

use App\Models\Rating;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;


class RatingRepository extends BaseRepository implements CacheableInterface{

    use CacheableRepository ;
    protected $cacheMinutes = 10;
    function model(){
        return Rating::class ;
    }
}
