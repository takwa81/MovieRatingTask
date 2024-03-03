<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RatingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'movie_id' => 'required|exists:movies,id',
            'rating' => 'required|integer|between:1,5',
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
