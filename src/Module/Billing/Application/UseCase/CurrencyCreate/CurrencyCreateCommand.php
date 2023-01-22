<?php

declare(strict_types=1);

namespace App\Module\Billing\Application\UseCase\CurrencyCreate;

class CurrencyCreateCommand
{
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

}