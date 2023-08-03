<?php

namespace App\Common\Security;

use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\{UserInterface, UserProviderInterface};

class GuardProvider implements UserProviderInterface
{
    public function __construct(private GuardUser $guardUser)
    {}

    public function loadUserByIdentifier(string $identifier): GuardUser
    {
        return $this->guardUser;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof GuardUser) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }
        return $this->guardUser = $user;
    }

    public function supportsClass(string $class): bool
    {
        return GuardUser::class === $class || is_subclass_of($class, GuardUser::class);
    }
}