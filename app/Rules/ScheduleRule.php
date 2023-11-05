<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ScheduleRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $jsonList = json_decode($value, true);

        if (!is_array($jsonList)) {
            $fail('');
        }

        foreach ($jsonList as $item) {
            if (!isset($item['day']) || !isset($item['hours'])) {
                $fail('The :attribute must be a valid list of JSON objects with a day and hours field.');
            }

        }
    }
}
