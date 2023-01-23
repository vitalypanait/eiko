<?php

declare(strict_types=1);

namespace App\Module\Billing\Domain\Repository;

use App\Module\Billing\Domain\Entity\Currency;

interface CurrencyRepository
{
    public function save(Currency $currency): void;

    public function catalogue(): array;

    public function getById(int $id): Currency;
}