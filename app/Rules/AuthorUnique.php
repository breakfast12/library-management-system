<?php

namespace App\Rules;

use App\Models\Author\Author;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class AuthorUnique implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Check if the author name exists
        $exists = Author::where(DB::raw('LOWER(name)'), strtolower($value))->exists();

        // trigger a validation failure
        if ($exists) {
            $fail('Name has already been taken.');
        }
    }
}
