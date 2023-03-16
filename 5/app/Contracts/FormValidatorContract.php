<?php

namespace App\Contracts;

interface FormValidatorContract
{
    /**
     * @param string[] $formData
     */
    public function __construct(array $formData);

    /**
     * @param \App\Contracts\ValidationRuleContract[] $rules
     * @return ValidationFormResultContract
     */
    public function validate(array $rules): ValidationFormResultContract;
}
