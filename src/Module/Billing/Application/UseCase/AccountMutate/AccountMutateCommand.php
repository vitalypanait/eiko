<?php

declare(strict_types=1);

namespace App\Module\Billing\Application\UseCase\AccountMutate;

class AccountMutateCommand
{
    public function __construct(
        private readonly int $id,
        private readonly string $name,
        private readonly string $color,
        private readonly int    $currencyId,
    ) {}

    public function getId(): int
    {
        return $this->id;
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