<?php

namespace App\Contracts;

interface ValidationRuleContract
{
    public function validate(array $formData): ValidationRuleResultContract;
}
