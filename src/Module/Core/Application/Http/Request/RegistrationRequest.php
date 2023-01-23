<?php

declare(strict_types=1);

namespace App\Module\Core\Application\Http\Request;

use App\Module\Common\Infrastructure\Request\IdentifierInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationRequest implements IdentifierInterface
{
    #[Assert\Email()]
    private readonly string $email;

    #[Assert\GreaterThanOrEqual(5)]
    private readonly string $password;

    public function __construct(string $email, string $password) {

        $this->email = $email;
        $this->password = $password;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}