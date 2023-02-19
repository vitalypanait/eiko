<?php

declare(strict_types=1);

namespace App\Module\Common\Infrastructure\Exception;

interface HasErrorsApiExceptionInterface extends ApiExceptionInterface
{
    public const GENERAL_ERROR = 'generalErrors';

    public function getErrors(): array;
}
