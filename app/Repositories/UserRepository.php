<?php 

namespace App\Repositories;

use App\Models\User;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Traits\CacheableRepository;


class UserRepository extends BaseRepository implements CacheableInterface{

    use CacheableRepository ;
    protected $cacheMinutes = 10;
    function model(){
        return User::class ;
    }
}