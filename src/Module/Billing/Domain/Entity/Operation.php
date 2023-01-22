<?php

declare(strict_types=1);

namespace App\Module\Billing\Domain\Entity;

use Brick\Math\BigDecimal;

class Operation
{
    private ?int $id;

    public function __construct(
        private Account $account,
        private BigDecimal $amount,
        private string $comment
    ) {}
}