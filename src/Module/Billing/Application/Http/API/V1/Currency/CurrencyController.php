<?php

declare(strict_types=1);

namespace App\Module\Billing\Application\Http\API\V1\Currency;

use App\Module\Billing\Application\Http\API\V1\Currency\Request\CreateRequest;
use App\Module\Billing\Application\UseCase\CurrencyCreate\CurrencyCreateCommand;
use App\Module\Billing\Domain\Entity\Currency;
use App\Module\Billing\Domain\Repository\CurrencyRepository;
use App\Module\Common\Bus\CommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CurrencyController extends AbstractController
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly CurrencyRepository $currencyRepository
    ) {}

    #[Route(
        '/api/v1/currencies',
        methods: ['GET']
    )]
    public function catalogue(): Response
    {
        return $this->json(
            array_map(
                fn(Currency $currency) => $currency->jsonSerialize(),
                $this->currencyRepository->catalogue()
            )
        );
    }

    #[Route(
        '/api/v1/currencies',
        methods: ['POST']
    )]
    public function create(CreateRequest $request): Response
    {
        $this->commandBus->execute(
            new CurrencyCreateCommand($request->getCode(), $request->getSymbol(), $request->getTitle())
        );

        return $this->json([]);
    }
}