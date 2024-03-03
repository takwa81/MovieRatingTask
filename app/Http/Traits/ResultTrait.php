<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait ResultTrait
{

    public function successResponse($data = null, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
            'code'=> $statusCode
        ], $statusCode);
    }

    public function errorResponse($message = 'Error', $statusCode = 500)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => "" ,
            'code'=>$statusCode
        ], $statusCode);
    }

    public function notFoundResponse($message = 'Not Found')
    {
        return $this->errorResponse($message, 404);
    }

    public function createdResponse($data = "", $message = 'Resource created')
    {
        return $this->successResponse($data, $message, 201);
    }

}
