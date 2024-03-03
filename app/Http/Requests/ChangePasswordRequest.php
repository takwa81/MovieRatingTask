<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
    }

    
    public function messages(): array
    {
        return [
            'old_password.required' => __('messages.The old password field is required.'),
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
