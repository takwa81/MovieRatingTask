<?php

namespace App\Services;

use App\Http\Traits\ResultTrait;
use App\Repositories\MovieRepository;

class MovieService
{
    protected $movieRepository;
    use ResultTrait;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function index(){
        $movies = $this->movieRepository->with('genre')->get();
        return $this->successResponse($movies, __('messages.Data Fetched Successfully'));
    }

}
