<?php

namespace App\Services\Validation;

use App\Contracts\ValidationRuleResultContract;

class ValidationRuleResult implements ValidationRuleResultContract
{
    private string $name;
    private bool $valid;
    private ?string $error;

    public function __construct(string $name, bool $valid, ?string $error = null)
    {
        $this->name = $name;
        $this->valid = $valid;
        $this->error = $error;
    }

    public function property(): string
    {
        return $this->name;
    }

    public function valid(): bool
    {
        return $this->valid;
    }

    public function error(): ?string
    {
        return $this->error;
    }

    public function __toString(): string
    {
        return $this->error ?? '';
    }
}
