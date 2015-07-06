<?php

namespace AppBundle\Security\Authentication;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\SimplePreAuthenticatorInterface;
use Symfony\Component\Security\Core\Authentication\Token\PreAuthenticatedToken;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use AppBundle\Security\User\ApiUserProvider;

class ApiTokenAuthenticator implements SimplePreAuthenticatorInterface
{
    const TOKEN_HEADER = 'Authorization';

    protected $userProvider;

    public function __construct(ApiUserProvider $userProvider)
    {
        $this->userProvider = $userProvider;
    }

    public function createToken(Request $request, $providerKey)
    {
        if (!$token = $request->headers->get(self::TOKEN_HEADER)) {
            return null;
        }

        return new PreAuthenticatedToken('anon.', $token, $providerKey);
    }

    public function authenticateToken(TokenInterface $token, UserProviderInterface $userProvider, $providerKey)
    {
        $apiToken = $token->getCredentials();

        if ($user = $this->userProvider->loadUserByToken($apiToken)) {
            return new PreAuthenticatedToken($user, $apiToken, $providerKey, $user->getRoles());
        }

        throw new AuthenticationException('Wrong API token or token has expired');
    }

    public function supportsToken(TokenInterface $token, $providerKey)
    {
        return $token instanceof PreAuthenticatedToken && $token->getProviderKey() === $providerKey;
    }
}