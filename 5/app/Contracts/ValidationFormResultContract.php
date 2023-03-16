<?php

namespace App\Contracts;

interface ValidationFormResultContract
{
    public function __construct(array $properties);

    public function addError(ValidationRuleResultContract $result): void;

    public function valid(): bool;

    public function errors(): array;

    public function hasError(string $property): bool;
}
