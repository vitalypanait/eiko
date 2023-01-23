<?php

declare(strict_types=1);

namespace App\Module\Billing\Application\Http\API\V1\Account\Request;

use App\Module\Common\Infrastructure\Request\IdentifierInterface;

class CreateRequest implements IdentifierInterface
{
    public function __construct(
        private readonly string $name,
        private readonly string $color,
        private readonly int $currencyId
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getCurrencyId(): int
    {
        return $this->currencyId;
    }
}