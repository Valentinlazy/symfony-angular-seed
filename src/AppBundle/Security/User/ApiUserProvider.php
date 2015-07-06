<?php

namespace AppBundle\Security\User;

use CoreDomain\Model\User;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use CoreDomain\Repository\UserRepositoryInterface;

class ApiUserProvider implements UserProviderInterface
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function loadUserByUsername($username)
    {
        if ($user = $this->userRepository->findOneByEmail($username)) {
            return $user;
        }

        throw new AuthenticationException('User was not found');
    }

    public function loadUserByToken($token)
    {
        if ($user = $this->userRepository->findOneByToken($token)) {
            return $user;
        }

        throw new AuthenticationException('User was not found');
    }

    public function refreshUser(UserInterface $user)
    {
        throw new UnsupportedUserException();
    }

    public function supportsClass($class)
    {
        return $class === User::class;
    }
}