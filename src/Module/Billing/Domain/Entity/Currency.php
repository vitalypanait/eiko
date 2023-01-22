<?php

declare(strict_types=1);

namespace App\Module\Billing\Domain\Entity;

use JsonSerializable;

class Currency implements JsonSerializable
{
    private ?int $id;

    public function __construct(
        private string $code,
        private string $symbol,
        private string $title
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

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'symbol' => $this->symbol,
            'title' => $this->title,
        ];
    }
}