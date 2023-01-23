<?php

declare(strict_types=1);

namespace App\Module\Billing\Application\UseCase\AccountMutate;

use App\Module\Billing\Domain\Repository\AccountRepository;
use App\Module\Billing\Domain\Repository\CurrencyRepository;
use App\Module\Common\Command\CommandHandler;

class AccountMutateHandler implements CommandHandler
{
    public function __construct(
        private readonly AccountRepository  $accountRepository,
        private readonly CurrencyRepository $currencyRepository
    ) {}

    public function __invoke(AccountMutateCommand $command): void
    {
        $account = $this->accountRepository->getById($command->getId());

        $account->update(
            $command->getName(),
            $command->getColor(),
            $this->currencyRepository->getById($command->getCurrencyId())
        );
    }
}