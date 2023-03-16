<?php

namespace App\Services\Validation;

use App\Contracts\ValidationRuleContract;
use App\Contracts\ValidationRuleResultContract;

abstract class BaseValidationRule implements ValidationRuleContract
{
    protected string $property;
    protected bool $required = false;

    abstract protected function valid(array $formData): ValidationRuleResultContract;

    public function __construct(string $property)
    {
        $this->property = $property;
    }

    public function required(): self
    {
        $this->required = true;
        return $this;
    }

    public function validate(array $formData): ValidationRuleResultContract
    {
        if ($this->required) {
            if (!isset($formData[$this->property]) || !$formData[$this->property]) {
                return $this->resultError('Поле является обязательным');
            }
        }

        return $this->valid($formData);
    }

    protected function resultValid(): ValidationRuleResultContract
    {
        return new ValidationRuleResult($this->property, true);
    }

    protected function resultError(string $error): ValidationRuleResultContract
    {
        return new ValidationRuleResult($this->property, false, $error);
    }
}
