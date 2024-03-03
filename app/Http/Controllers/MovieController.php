<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResultTrait;
use App\Services\MovieService;
use Exception;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    use ResultTrait ;
    protected $movieService ;

    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService ;
    }

    public function index(){
        try{
            return $this->movieService->index();
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }
    }
}
