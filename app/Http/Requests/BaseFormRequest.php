<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        // Create a JSON response with the validation errors
        // and 400 status code
        $response = response()->json([
            'status' => 'error',
            'message' => $validator->errors(),
        ], 400);

        // Throw an HttpResponseException with the response
        throw new HttpResponseException($response);
    }

    /**
     * Get the data for validation.
     *
     * @return array
     */
    public function validationData()
    {
        // Merge all input data with the 'id' from the route parameters
        return array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);
    }
}
