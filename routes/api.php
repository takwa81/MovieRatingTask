<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['api_localization'])->group(function () {
    // Public Routes
    Route::post('/signup', [AuthController::class, 'SignUp']);
    Route::post('/login', [AuthController::class, 'Login']);
    Route::post('/verify', [AuthController::class, 'Verify']);
    Route::post('/forgetPassword', [AuthController::class, 'ForgetPassword']);
    Route::post('/resetPassword', [AuthController::class, 'ResetPassowrd']);

    // Private Routes
    Route::middleware(['jwt.verify'])->group(function () {
        Route::get('/profile', [AuthController::class, 'Profile']);
        Route::post('/updateProfile', [AuthController::class, 'updateProfile']);
        Route::post('/logout', [AuthController::class, 'Logout']);
        Route::post('/changePassword', [AuthController::class, 'changePassword']);
        Route::get('/movies',[MovieController::class,'index']);
        Route::post('/rating',[RatingController::class,'store']);
    });
});
