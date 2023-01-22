<?php

declare(strict_types=1);

namespace App\Module\Core\Application\Http\Controller;

use App\Module\Core\Domain\Entity\User;
use App\Module\Core\Infrastructure\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

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
    public function index(Request $request): Response
    {
        $request = $this->transformJsonBody($request);

        $user = new User();
        $user->setEmail($request->get('email'));

        $password = $this->passwordHasher->hashPassword($user, $request->get('password'));

        $user->setPassword($password);

        $this->userRepository->save($user, true);

        return new Response($user->getUserIdentifier());
    }

    private function transformJsonBody(Request $request): Request
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }
}