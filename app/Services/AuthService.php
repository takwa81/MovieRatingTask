<?php

namespace App\Services;

use App\Http\Resources\TechnicianResource;
use App\Http\Traits\ResultTrait;
use App\Jobs\EmailVerificationJob;
use App\Jobs\ResetPasswordJob;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService 
{
    protected $userRepository;
    use ResultTrait;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function SignUp($request)
    {
        try {
            DB::beginTransaction();
    
            $hashedPassword = Hash::make($request->input('password'));
    
            $user = $this->userRepository->create([
                'user_name' => $request->input('user_name'),
                'full_name' => $request->input('full_name'),
                'email' => $request->input('email'),
                'password' => $hashedPassword,
                // 'code' => mt_rand(100000, 999999),
                'code' => "000000",
                'verify_email_send_at' => now(),
            ]);
    
            // $email['email'] = $user->email;
            // $data = [
            //     'full_name' => $user->full_name,
            //     'user_name' => $user->user_name,
            //     'code' => $user->code,
            // ];
    
            // dispatch(new EmailVerificationJob($data, $email));
            $token = JWTAuth::fromUser($user);
    
            DB::commit();
    
            return $this->successResponse(['user' => $user, 'token' => $token], __('messages.Please Check Your Email we are send verification code, Verify it please'));
        } catch (\Exception $e) {
            DB::rollBack();
    
            return $this->errorResponse($e->getMessage(), 500);
        }
    }


   

    public function Verify($request){
        $user = $this->userRepository->where('email',$request->input('email'))->first();
        // dd($user);
        if($request->input('code') != $user->code){
            return $this->errorResponse(__('messages.Verify Code Not Correct'),422);
        }else{
            $user->code = null ;
            $user->verify_email_send_at = null ;
            $user->email_verified_at = now() ;
            $user->is_verify = true ;
            $user->save() ;
            return $this->successResponse(__('messages.Email Verified Successfully , You can Login Now') ,200);
        }
        
    }


    public function Login($credentials){
        if(!Auth::attempt($credentials)){
            return $this->errorResponse(__('messages.Invalid email or password'), 401);
        }
        $token = JWTAuth::attempt($credentials);
        if(!$token){
            return $this->errorResponse('Unable to generate token', 500);
        }
        return $this->successResponse(['token' => $token], __('messages.Login successfully'));
    }

    public function Profile(){
        $user = $this->userRepository->find(Auth()->user()->id);
        return $this->successResponse($user) ;

    }

    public function updateProfile($request){
        $user = $this->userRepository->find(Auth()->user()->id);
        $user->update([
            'user_name' => $request->input('user_name')? $request->input('user_name'):$user->user_name, 
            'full_name' => $request->input('full_name')? $request->input('full_name'):$user->full_name, 
            'email' => $request->input('email')? $request->input('email'):$user->email, 
            // 'password' => $request->input('password')? Hash::make($request->input('password')) :$user->pasword, 
        ]);
        return $this->successResponse($user, 'Profile updated successfully');
    }

    public function Logout(){
        Auth::logout();
        return response()->json(['message' => __('messages.Logout successful')], 200);
    }

    public function ResetPassowrd($request){
        $user = $this->userRepository->where('email',$request->input('email'))->first();
        if($user->code != null){
            return $this->errorResponse(__('messages.Not Verify Reset Pasword Code , Verify it please and try again'), 500);
        }
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return $this->successResponse($user, __('messages.Reset Password Successfully'));
    }
    
    public function ForgetPassword($request)
    {
        return DB::transaction(function () use ($request) {
            $user = $this->userRepository->where('email', $request->input('email'))->first();
            // $user->code = mt_rand(100000, 999999);
            $user->code = "000000";
            $user->save();
    
            $email['email'] = $user->email;
            $data = [
                'full_name' => $user->full_name,
                'user_name' => $user->user_name,
                'code' => $user->code,
            ];
    
            dispatch(new ResetPasswordJob($data, $email));
    
            return $this->successResponse($user, __('messages.Please Check Your Email, and Verify it'));
        });
    }

    public function changePassword($request)
    {
        $user = Auth::user();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return $this->errorResponse(__('messages.Old password does not match.'), 422);
        }

        $user->password = Hash::make($request->input('password'));
        $user->save();

        return $this->successResponse(null, __('messages.Password changed successfully.'));
    }
  
}
