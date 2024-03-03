<?php

namespace App\Services;

use App\Http\Requests\RatingRequest;
use App\Http\Traits\ResultTrait;
use App\Repositories\MovieRepository;
use App\Repositories\RatingRepository;

class RatingService
{
    protected $ratingRepository;
    use ResultTrait;

    public function __construct(RatingRepository $ratingRepository)
    {
        $this->ratingRepository = $ratingRepository;
    }

    public function store($request){
        $request['user_id'] = auth()->user()->id;
        $rating = $this->ratingRepository->create($request->all());
        return $this->successResponse($rating, __('messages.Rating Added Successfully'));
    }

}
