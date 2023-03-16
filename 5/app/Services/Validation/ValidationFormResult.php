<?php

namespace App\Services\Validation;

use App\Contracts\LoggableContract;
use App\Contracts\ValidationFormResultContract;
use App\Contracts\ValidationRuleResultContract;

class ValidationFormResult implements ValidationFormResultContract, LoggableContract
{
    private array $errors = [];
    private array $properties;

    public function __construct(array $properties)
    {
        $this->properties = $properties;
    }

    public function addError(ValidationRuleResultContract $result): void
    {
        $this->errors[$result->property()] = $result->error();
    }

    public function valid(): bool
    {
        return count($this->errors) == 0;
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function hasError(string $property): bool
    {
        return isset($this->errors[$property]);
    }

    public function toLogMessage(): string
    {
        return json_encode([
            'valid' => $this->valid(),
            'errors' => $this->errors(),
            'data' => $this->properties,
        ]);
    }
}
