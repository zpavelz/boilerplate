<?php

namespace App\Common\Security;

use InvalidArgumentException;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\{Badge\UserBadge, Passport, SelfValidatingPassport};

class ApiAuthenticator extends AbstractAuthenticator
{
    private GuardUser $guardUser;

    public function __construct(GuardProvider $guardProvider)
    {
        $this->guardUser = $guardProvider->loadUserByIdentifier('');
    }

    public function supports(Request $request): bool
    {
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new JsonResponse([
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function authenticate(Request $request): Passport
    {
        $apiToken = $request
            ->headers
            ->get(
                $this->guardUser->getUserIdentifier()
            )
        ;

        if (
            null === $apiToken ||
            $apiToken !== $this->guardUser->getTokenValue()
        ) {
            throw new InvalidArgumentException('Invalid API token provided', 401);
        }

        return new SelfValidatingPassport(
            new UserBadge(
                $apiToken
            )
        );
    }
}