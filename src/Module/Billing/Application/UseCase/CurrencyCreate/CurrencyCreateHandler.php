<?php

declare(strict_types=1);

namespace App\Module\Billing\Application\UseCase\CurrencyCreate;

use App\Module\Billing\Domain\Entity\Currency;
use App\Module\Billing\Domain\Repository\CurrencyRepository;
use App\Module\Common\Command\CommandHandler;

class CurrencyCreateHandler implements CommandHandler
{
    public function __construct(
        private readonly CurrencyRepository $repository
    ) {}

    public function __invoke(CurrencyCreateCommand $command): void
    {
        $this->repository->save(new Currency($command->getCode(), $command->getSymbol(), $command->getTitle()));
    }
}