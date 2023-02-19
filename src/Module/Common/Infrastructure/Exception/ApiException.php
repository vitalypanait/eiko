<?php

declare(strict_types=1);

namespace App\Module\Common\Infrastructure\Exception;

use Exception;

class ApiException extends Exception implements ApiExceptionInterface
{
    public const CODE = 500;

    public const DESCRIPTION = '';
}
