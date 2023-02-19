<?php

declare(strict_types=1);

namespace App\Module\Common\Infrastructure\Model;

class RequestExceptionResponseModel
{
    public function __construct(
        private readonly string $message,
        private array $errors = []
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function setErrors(array $errors): void
    {
        $this->errors = $errors;
    }
}
