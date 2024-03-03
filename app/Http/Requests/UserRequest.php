<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

  
    public function rules(): array
    {
        return [
            'user_name' => 'required|unique:users',
            'full_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ];
    }

  
    public function messages(): array
    {
        return [
            'user_name.required' => __('messages.The username field is required.'),
            'user_name.unique' => __('messages.The username has already been taken.'),
            'fullname.required' => __('messages.The fullname field is required.'),
            'email.required' => __('messages.The email field is required.'),
            'email.email' => __('messages.Please enter a valid email address.'),
            'email.unique' => __('messages.The email has already been taken.'),
            'password.required' => __('messages.The password field is required.'),
            'password.min' => __('messages.The password must be at least :min characters.'),
            'password.confirmed' => __('messages.The password confirmation does not match.'),
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->toArray();
        $errorCount = count($errors);

        $response = [
            'message' => $errorCount > 1
                ? 'Errors exist (and ' . $errorCount . ' more errors)'
                : 'Error exists',
            'data' => $errors,
            'status' => "error"
        ];
        throw new HttpResponseException(response()->json($response, 422));
    }
}
