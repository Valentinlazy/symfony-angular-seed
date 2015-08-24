<?php

namespace CoreDomain\Command\User;

use CoreDomain\Command\CommandInterface;
use CoreDomain\DTO\UserDTO;
use CoreDomain\Exception\LogicException;
use CoreDomain\Exception\EntityNotFoundException;

class AddSessionCommand implements CommandInterface
{
    private $userRepository;
    private $sessionRepository;
    private $encoder;

    public function __construct(
        \CoreDomain\Repository\UserRepositoryInterface $userRepository,
        \CoreDomain\Repository\UserSessionRepositoryInterface $sessionRepository,
        \CoreDomain\Security\PasswordStrategyInterface $encoder
    ) {
        $this->userRepository = $userRepository;
        $this->sessionRepository = $sessionRepository;
        $this->encoder = $encoder;
    }

    public function execute($dto)
    {
        if (!($dto instanceof UserDTO)) {
            throw new LogicException('Incorrect DTO. Need '.UserDTO::class);
        }

        $user = $this->userRepository->findOneByEmail($dto->email);
        if (!$user) {
            throw new EntityNotFoundException('User not found');
        }

        if (!$this->encoder->isPasswordValid($dto->password, $user->getPassword(), $user->getSalt())) {
            throw new EntityNotFoundException('Password incorrect');
        }

        $session = $user->login();
        $this->sessionRepository->addAndSave($session);

        return $session;
    }
}
