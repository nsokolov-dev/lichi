<?php

namespace App\Contracts;

interface LoggerContract
{
    /**
     * @param string|\App\Contracts\LoggableContract $message
     * @return void
     */
    public function write($message): void;
}
