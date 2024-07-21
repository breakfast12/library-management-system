<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistsSoftDelete implements ValidationRule
{
    /**
     * The model to validate against.
     *
     * @var string
     */
    protected $model;

    /**
     * The validation error message.
     *
     * @var string
     */
    protected $message;

    /**
     * Create a new rule instance.
     *
     * @param string
     * @param string
     */
    public function __construct($model, $message)
    {
        $this->model = $model;
        $this->message = $message;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Create instance from model
        $modelInstance = new $this->model;

        // Check if the record exists and is not soft deleted
        $recordExists = $modelInstance::withTrashed()->where('id', $value)->exists();
        $isSoftDeleted = $modelInstance::onlyTrashed()->where('id', $value)->exists();

        // trigger a validation failure
        if (! $recordExists || $isSoftDeleted) {
            $fail($this->message);
        }
    }
}
