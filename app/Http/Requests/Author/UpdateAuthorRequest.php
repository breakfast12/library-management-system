<?php

namespace App\Http\Requests\Author;

use App\Http\Requests\BaseFormRequest;
use App\Rules\AuthorUnique;

class UpdateAuthorRequest extends BaseFormRequest
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
            'id' => 'exists:authors,id',
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
            'id.exists' => 'Author ID does not exist.',
        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), [
            'id' => $this->route('id'),
        ]);
    }
}
