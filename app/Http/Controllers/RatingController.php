<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatingRequest;
use App\Http\Traits\ResultTrait;
use App\Services\RatingService;
use Exception;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    use ResultTrait ;
    protected $ratingService ;

    public function __construct(RatingService $ratingService)
    {
        $this->ratingService = $ratingService ;
    }

    public function store(RatingRequest $request){
        try{
            return $this->ratingService->store($request);
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }
    }
}
