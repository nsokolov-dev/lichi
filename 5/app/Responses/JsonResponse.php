<?php

namespace App\Responses;

class JsonResponse extends BaseResponse
{
    private array $errors = [];

    public function get(): string
    {
        $this->responseHeader();

        return json_encode([
            'status' => !$this->isErrorCode() ? 'ok' : 'error',
            'errors' => $this->errors(),
        ]);
    }

    private function errors(): array
    {
        if ($this->isErrorCode()) {
            return $this->errors;
        }
        return [];
    }

    /**
     * Задать ошибки для ответа
     *
     * @param string[]|\App\Contracts\ValidationRuleResultContract[] $errors
     * @return $this
     */
    public function setErrors(array $errors): self
    {
        $this->errors = $errors;
        return $this;
    }
}
