<?php

namespace Core\Rules;

use Closure;
use Core\Parents\BaseModel;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class FieldsIsAvailable implements ValidationRule
{
    /**
     * The name of the corresponding model.
     * @var class-string<BaseModel> $model
     */
    private string $model;

    /**
     * Create a new rule instance.
     */
    public function __construct(string $model)
    {
        $this->model = $model;
    }

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @var class-string<BaseModel> $model */
        $model = $this->model;

        $diffs = array_diff($value, $model::OPEN_FIELDS);
        if (count($diffs) > 0) {
            $fail("The \"$diffs[0]\" field is not available for receiving.");
        }
    }
}
