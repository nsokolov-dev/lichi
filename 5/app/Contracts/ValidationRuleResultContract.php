<?php

namespace App\Contracts;

interface ValidationRuleResultContract
{
    public function property(): string;

    public function valid(): bool;

    public function error(): ?string;

    public function __toString(): string;
}
