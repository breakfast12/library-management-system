<?php

namespace App\Http\Requests\Author;

use App\Http\Requests\BaseFormRequest;
use App\Rules\AuthorUnique;

class StoreAuthorRequest extends BaseFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                new AuthorUnique,
            ],
            'bio' => 'required',
            'birth_date' => 'required|date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required.',
            'bio.required' => 'Bio is required.',
            'birth_date.required' => 'Birth date is required.',
            'birth_date.date' => 'Birth date must be valid date.',
        ];
    }
}
