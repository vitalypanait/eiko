<?php

declare(strict_types=1);

namespace App\Module\Core\Listener;

use App\Module\Core\Domain\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

class AuthenticationSuccessListener
{
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event): void
    {
        $data = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof User) {
            return;
        }

        $data['payload'] = [
            'userId' => $user->getId()
        ];

        $event->setData($data);
    }
}