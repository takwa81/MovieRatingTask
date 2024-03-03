<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class ForgetPasswordRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:users,email',
        ];
    }


    public function messages(): array
    {
        return [
            'email.required' => __('messages.The email field is required.'),
            'email.email' => __('messages.Please enter a valid email address.'),
            'email.exists' => __('messages.The provided email does not exist in our records.'),
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
