<?php

declare(strict_types=1);

namespace App\Module\Billing\Domain\Entity;

use JsonSerializable;

class Account implements JsonSerializable
{
    private ?int $id;

    public function __construct(
        private readonly int $userId,
        private Currency $currency,
        private string $name,
        private string $color
    ) {}

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'name' => $this->name,
            'color' => $this->color,
            'currency' => $this->currency->jsonSerialize()
        ];
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function update(string $name, string $color, Currency $currency): void
    {
        $this->name = $name;
        $this->color = $color;
        $this->currency = $currency;
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}