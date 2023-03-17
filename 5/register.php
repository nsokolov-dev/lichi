<?php

require 'vendor/autoload.php';

use App\Contracts\ServerResponseContract as ServerResponse;
use App\Responses\JsonResponse;
use App\Responses\ResponseStatus;
use App\Services\FileLogger;
use App\Services\FormValidator;
use App\Services\Validation\ValidationRule;
use App\Services\Validation\EmailValidationRule;
use App\Services\Validation\PasswordValidationRule;

function response(ServerResponse $response): void
{
    echo $response->get();
}

function getPutData(): array
{
    return json_decode(file_get_contents("php://input"), true);
}

function handleRequest(): void
{
    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        $formData = getPutData();

        $validationResult = (new FormValidator($formData))
            ->validate([
                (new ValidationRule('first_name'))->required(),
                (new ValidationRule('last_name'))->required(),
                (new EmailValidationRule('email'))->required(),
                (new PasswordValidationRule('password'))
                    ->confirmProperty('password_confirmation')->required(),
            ]);

        if ($validationResult->valid()) {
            $jsonResp = new JsonResponse([], ResponseStatus::CREATED);
        } else {
            $jsonResp = (new JsonResponse([], ResponseStatus::UNPROCESSABLE_ENTITY))
                ->setErrors($validationResult->errors());
        }

        (new FileLogger())->write($validationResult);

        response($jsonResp);
    } else {
        header("Location: /");
        die();
    }
}

const ROOT_PATH = __DIR__;

handleRequest();
