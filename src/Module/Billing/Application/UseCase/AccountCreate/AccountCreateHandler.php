<?php

declare(strict_types=1);

namespace App\Module\Billing\Application\UseCase\AccountCreate;

use App\Module\Billing\Domain\Entity\Account;
use App\Module\Billing\Domain\Repository\AccountRepository;
use App\Module\Billing\Domain\Repository\CurrencyRepository;
use App\Module\Common\Command\CommandHandler;

class AccountCreateHandler implements CommandHandler
{
    public function __construct(
        private readonly AccountRepository $repository,
        private readonly CurrencyRepository $currencyRepository
    ) {}

    public function __invoke(AccountCreateCommand $command): void
    {
        $this->repository->save(
            new Account(
                $command->getUserId(),
                $this->currencyRepository->getById($command->getCurrencyId()),
                $command->getName(),
                $command->getColor()
            )
        );
    }
}