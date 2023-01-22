<?php

declare(strict_types=1);

namespace App\Module\Billing\Domain\Entity;

class Account
{
    private ?int $id;

    public function __construct(
        private Currency $currency,
        private string $name,
        private string $color
    ) {}

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return $this->color;
    }
}