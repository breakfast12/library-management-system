<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\BaseFormRequest;
use App\Models\Book\Book;
use App\Rules\ExistsSoftDelete;

class ParamBookRequest extends BaseFormRequest
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
            'id' => [
                new ExistsSoftDelete(Book::class,
                    'Book ID does not exist.'),
            ],
        ];
    }
}
