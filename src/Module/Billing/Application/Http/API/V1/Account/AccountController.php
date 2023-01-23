<?php

declare(strict_types=1);

namespace App\Module\Billing\Application\Http\API\V1\Account;

use App\Module\Billing\Application\Http\API\V1\Account\Request\CreateRequest;
use App\Module\Billing\Application\Http\API\V1\Account\Request\UpdateRequest;
use App\Module\Billing\Application\UseCase\AccountCreate\AccountCreateCommand;
use App\Module\Billing\Application\UseCase\AccountMutate\AccountMutateCommand;
use App\Module\Billing\Domain\Entity\Account;
use App\Module\Billing\Domain\Repository\AccountRepository;
use App\Module\Common\Bus\CommandBus;
use App\Module\Core\Infrastructure\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly AccountRepository $accountRepository,
        private readonly UserRepository $userRepository
    ) {}

    #[Route(
        '/api/v1/accounts',
        methods: ['GET']
    )]
    public function catalogue(): Response
    {
        return $this->json(
            array_map(
                fn(Account $account) => $account->jsonSerialize(),
                $this->accountRepository->findByUser($this->getUserId())
            )
        );
    }

    #[Route(
        '/api/v1/accounts',
        methods: ['POST']
    )]
    public function create(CreateRequest $request): Response
    {
        $this->commandBus->execute(
            new AccountCreateCommand(
                $this->getUserId(),
                $request->getName(),
                $request->getColor(),
                $request->getCurrencyId(),
            )
        );

        return $this->json([]);
    }

    #[Route(
        '/api/v1/accounts/{id}',
        methods: ['PUT']
    )]
    public function update(int $id, UpdateRequest $request): Response
    {
        $account = $this->accountRepository->findById($id);

        if ($account === null || $account->getUserId() !== $this->getUserId()) {
            throw new NotFoundHttpException();
        }

        $this->commandBus->execute(
            new AccountMutateCommand(
                $account->getId(),
                $request->getName(),
                $request->getColor(),
                $request->getCurrencyId(),
            )
        );

        return $this->json([]);
    }

    private function getUserId(): int
    {
       return $this->userRepository->findOneBy(['email' => $this->getUser()->getUserIdentifier()])->getId();
    }
}