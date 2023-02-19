<?php

declare(strict_types=1);

namespace App\Module\Common\Infrastructure\Exception;

use Throwable;

class BadRequestException extends ApiException implements HasErrorsApiExceptionInterface
{
    public const CODE = 490;
    public const DESCRIPTION = 'Некорректный запрос (запрос не прошел валидацию)';

    private array $errors = [];

    public function __construct(
        string $message = self::DESCRIPTION,
        int $code = self::CODE,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    public function addError(string $message, $key = null): void
    {
        if (is_string($key)) {
            $this->errors[$key][] = $message;
        } else {
            $this->errors[HasErrorsApiExceptionInterface::GENERAL_ERROR][] = $message;
        }
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
