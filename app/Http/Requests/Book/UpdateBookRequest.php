<?php

namespace App\Http\Requests\Book;

use App\Http\Requests\BaseFormRequest;
use App\Models\Author\Author;
use App\Models\Book\Book;
use App\Rules\ExistsSoftDelete;

class UpdateBookRequest extends BaseFormRequest
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
            'title' => 'required',
            'description' => 'required',
            'publish_date' => 'required|date',
            'author_id' => [
                    'required',
                    'integer',
                    new ExistsSoftDelete(Author::class,
                        'Author does not exist.'),
            ],
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
            'title.required' => 'Title is required.',
            'description.required' => 'Description is required.',
            'publish_date.required' => 'Publish Date is required.',
            'publish_date.date' => 'Publish Date must be valid date.',
            'author_id.required' => 'Author is required.',
            'author_id.integer' => 'Author ID must be valid integer.',
        ];
    }
}
