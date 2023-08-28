<?php

namespace Core\Rules;

use Closure;
use Core\Parents\BaseModel;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

readonly class FieldsIsAvailable implements ValidationRule
{
    /**
     * Create a new rule instance.
     */
    public function __construct(
        private string $model,
    ) {}

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param Closure(string): PotentiallyTranslatedString $fail
     * @return void
     * @noinspection PhpRedundantVariableDocTypeInspection
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        /** @var class-string<BaseModel> $model */
        $model = $this->model;
        $diffs = array_values(array_diff($value, $model::OPEN_FIELDS));

        if (count($diffs) > 0) {
            $fail("The \"$diffs[0]\" field is not available for receiving.");
        }
    }
}
