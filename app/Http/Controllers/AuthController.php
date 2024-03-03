<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UserRequest;
use App\Http\Requests\VerifyRequest;
use App\Http\Traits\ResultTrait;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ResultTrait; 
    protected $authService ;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService ;
    }

    public function SignUp(UserRequest $request){
        try{
            return $this->authService->SignUp($request);
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }

    }


    public function Verify(VerifyRequest $request){
        try{
            return $this->authService->Verify($request) ;
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }
    }


    public function Login(LoginRequest $request){
        $credentials = $request->only('email', 'password');
        try{
            return $this->authService->Login($credentials) ;
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }
    }


    public function Profile(){
        try{
            return $this->authService->Profile() ;
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }
    }

    public function updateProfile(Request $request){
        try{
            return $this->authService->updateProfile($request) ;
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }
    }

    public function Logout(){
        try{
            return $this->authService->Logout() ;
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }
    }

    public function ResetPassowrd(ResetPasswordRequest $request){
        try{
            return $this->authService->ResetPassowrd($request) ;
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }
    }
    public function ForgetPassword(ForgetPasswordRequest $request){
        try{
            return $this->authService->ForgetPassword($request) ;
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }
    }
    public function changePassword(ChangePasswordRequest $request){
        try{
            return $this->authService->changePassword($request) ;
        }
        catch(Exception $e){
            return $this->errorResponse($e->getMessage() , 500);
        }
    }
}
