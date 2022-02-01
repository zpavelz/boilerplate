<?php

namespace App\Common\Security;

use Symfony\Component\Security\Core\User\UserInterface;

class GuardUser implements UserInterface
{
    public function __construct(
        private string $tokenKey,
        private string $tokenValue
    ){}

    public function getRoles(): array
    {
        return [
            'ROLE_USER',
        ];
    }

    public function eraseCredentials(): void
    {
        $this->tokenKey = '';
        $this->tokenValue = '';
    }

    public function getUserIdentifier(): string
    {
        return $this->tokenKey;
    }

    public function getTokenValue(): string
    {
        return $this->tokenValue;
    }
}