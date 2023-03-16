<?php

namespace App\Contracts;

interface ServerResponseContract
{
    public function __construct(array $data, int $status = 200);

    /**
     * Получить ответ сервера
     *
     * @return string
     */
    public function get(): string;
}
