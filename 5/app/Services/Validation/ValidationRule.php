<?php

namespace App\Services\Validation;

use App\Contracts\ValidationRuleResultContract;

class ValidationRule extends BaseValidationRule
{
    protected function valid(array $formData): ValidationRuleResultContract
    {
        return $this->resultValid();
    }
}
