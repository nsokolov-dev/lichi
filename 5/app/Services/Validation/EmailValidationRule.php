<?php

namespace App\Services\Validation;

use App\Contracts\ValidationRuleResultContract;
use App\Repositories\UserRepository;

class EmailValidationRule extends BaseValidationRule
{
    protected bool $unique;

    protected function valid(array $formData): ValidationRuleResultContract
    {
        if (!filter_var($formData[$this->property], FILTER_VALIDATE_EMAIL)) {
            return $this->resultError('Не корректный e-mail адрес');
        }

        $repository = new UserRepository();
        if ($repository->userExists($formData[$this->property])) {
            return $this->resultError('Пользователь с таким e-mail уже зарегистрирован');
        }

        return $this->resultValid();
    }

    public function unique(): self
    {
        $this->unique = true;
        return $this;
    }
}
