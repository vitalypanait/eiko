<?php

declare(strict_types=1);

namespace App\Module\Billing\Domain\Repository;

use App\Module\Billing\Domain\Entity\Account;

interface AccountRepository
{
    public function save(Account $account): void;

    /**
     * @return Account[]
     */
    public function findByUser(int $userId): array;

    public function findById(int $id): ?Account;

    public function getById(int $id): Account;
}