<?php

declare(strict_types=1);

namespace App\Module\Billing\Application\UseCase\AccountCreate;

class AccountCreateCommand
{
    public function __construct(
        private readonly int    $userId ,
        private readonly string $name,
        private readonly string $color,
        private readonly int    $currencyId,
    ) {}

    public function getUserId(): int
    {
        return $this->userId;
    }

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