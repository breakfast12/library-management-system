<?php

namespace App\Rules;

use App\Models\Author\Author;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AuthorUnique implements ValidationRule
{
    protected $authorId;

    public function __construct($authorId = null)
    {
        $this->authorId = $authorId;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the author name exists
        $exists = Author::where('name', $value)
            ->where('id', '!=', $this->authorId)
            ->exists();

        // trigger a validation failure
        if ($exists) {
            $fail('Name has already been taken.');
        }
    }
}
