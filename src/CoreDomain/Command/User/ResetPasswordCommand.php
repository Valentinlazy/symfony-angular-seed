<?php

namespace CoreDomain\Command\User;

use CoreDomain\Exception\EntityNotFoundException;
use CoreDomain\Exception\LogicException;
use CoreDomain\Model\Password;
use CoreDomain\Command\CommandInterface;

class ResetPasswordCommand implements CommandInterface
{
    private $userRepository;
    private $encoder;
    private $messenger;

    public function __construct(
        \CoreDomain\Repository\UserRepositoryInterface $userRepository,
        \CoreDomain\Security\PasswordStrategyInterface $encoder,
        \CoreDomain\Infrastructure\Mail\MessengerInterface $messenger
    ) {
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
        $this->messenger = $messenger;
    }

    public function execute($dto)
    {
        if (!isset($dto->email)){
            throw new LogicException('Incorrect DTO. Need email property');
        }
        $user = $this->userRepository->findOneByEmail($dto->email);
        if (!$user) {
            throw new EntityNotFoundException('User not found');
        }
        $password = new Password($this->encoder);
        $user->changePassword($password);
        $this->userRepository->addAndSave($user);
        $this->messenger->sendResettingEmailMessage($user, $password);
    }
}
