<?php

declare(strict_types=1);

namespace App\Module\Core\Application\Http\Controller;

use App\Module\Core\Application\Http\Request\RegistrationRequest;
use App\Module\Core\Domain\Entity\User;
use App\Module\Core\Infrastructure\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordHasher,
        private readonly UserRepository              $userRepository
    ) {}

    #[Route(
        '/registration',
        name: 'registration',
    )]
    public function index(RegistrationRequest $request): Response
    {
        $user = new User();
        $user->setEmail($request->getEmail());

        $password = $this->passwordHasher->hashPassword($user, $request->getPassword());

        $user->setPassword($password);

        $this->userRepository->save($user, true);

        return new Response($user->getUserIdentifier());
    }
}