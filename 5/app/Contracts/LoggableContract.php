<?php

namespace App\Contracts;

interface LoggableContract
{
    public function toLogMessage(): string;
}
