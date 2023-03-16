<?php

namespace App\Services;

use App\Contracts\FormValidatorContract;
use App\Contracts\ValidationFormResultContract;
use App\Services\Validation\ValidationFormResult;

class FormValidator implements FormValidatorContract
{
    protected array $formData;

    /**
     * @param string[] $formData
     */
    public function __construct(array $formData)
    {
        $this->formData = $formData;
    }

    /**
     * @param \App\Contracts\ValidationRuleContract[] $rules
     * @return ValidationFormResultContract
     */
    public function validate(array $rules): ValidationFormResultContract
    {
        $validationResult = new ValidationFormResult($this->formData);

        foreach ($rules as $rule) {
            $ruleResult = $rule->validate($this->formData);

            if (!$ruleResult->valid()) {
                $validationResult->addError($ruleResult);
            }
        }

        return $validationResult;
    }
}
