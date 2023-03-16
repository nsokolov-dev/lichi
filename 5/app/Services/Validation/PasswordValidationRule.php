<?php

namespace App\Services\Validation;

use App\Contracts\ValidationRuleResultContract;

class PasswordValidationRule extends BaseValidationRule
{
    private string $confirmProperty;

    public function confirmProperty(string $confirmProperty): self
    {
        $this->confirmProperty = $confirmProperty;
        return $this;
    }

    /**
     * @throws \Exception
     */
    protected function valid(array $formData): ValidationRuleResultContract
    {
        if (!isset($this->confirmProperty)) {
            throw new \Exception('$confirmProperty property not set');
        }

        $valid = $formData[$this->property] === $formData[$this->confirmProperty];

        if ($valid) {
            return $this->resultValid();
        }
        return $this->resultError('Пароли не совпадают');
    }
}
