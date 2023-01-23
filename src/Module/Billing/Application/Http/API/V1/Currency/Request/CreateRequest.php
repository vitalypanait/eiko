<?php

declare(strict_types=1);

namespace App\Module\Billing\Application\Http\API\V1\Currency\Request;

use App\Module\Common\Infrastructure\Request\IdentifierInterface;

class CreateRequest implements IdentifierInterface
{
    public function __construct(
        private readonly string $code,
        private readonly string $symbol,
        private readonly string $title
    ) {}

    public function getCode(): string
    {
        return $this->code;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}