<?php

namespace App\Responses;

abstract class ResponseStatus
{
    const OK = 200,
        CREATED = 201,
        UNPROCESSABLE_ENTITY = 422,
        INTERNAL_SERVER_ERROR = 500;
}
