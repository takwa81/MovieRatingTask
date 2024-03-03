<?php

namespace App\Repositories;

use App\Models\Genre;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;


class GenreRepository extends BaseRepository implements CacheableInterface{

    use CacheableRepository ;
    protected $cacheMinutes = 10;
    function model(){
        return Genre::class ;
    }
}
