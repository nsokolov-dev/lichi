<?php

namespace App\Responses;

use App\Contracts\ServerResponseContract;

abstract class BaseResponse implements ServerResponseContract
{
    protected array $data;
    protected int $status;

    public function __construct(array $data = [], int $status = 200)
    {
        $this->data = $data;
        $this->status = $status;
    }

    protected function responseStatus($code): string
    {
        $status = array(
            ResponseStatus::OK => 'OK',
            ResponseStatus::CREATED => 'CREATED',
            ResponseStatus::UNPROCESSABLE_ENTITY => 'UNPROCESSABLE ENTITY',
            ResponseStatus::INTERNAL_SERVER_ERROR => 'INTERNAL SERVER ERROR',
        );
        return ($status[$code]) ?: $status[ResponseStatus::INTERNAL_SERVER_ERROR];
    }

    protected function responseHeader()
    {
        header("HTTP/1.1 " . $this->status . " " . $this->responseStatus($this->status));
    }

    protected function isErrorCode(): bool
    {
        $codeGroup = substr($this->status, 0, 1);
        return $codeGroup == 4 || $codeGroup == 5;
    }
}
