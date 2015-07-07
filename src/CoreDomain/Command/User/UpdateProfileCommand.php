<?php

namespace CoreDomain\Command\User;

use CoreDomain\Command\CommandInterface;
use CoreDomain\DTO\UserDTO;
use CoreDomain\Exception\LogicException;
use CoreDomain\Model\User;

class UpdateProfileCommand implements CommandInterface
{
    private $userRepository;
    private $encoder;

    public function __construct (
        \CoreDomain\Repository\UserRepositoryInterface $userRepository,
        \CoreDomain\Security\PasswordStrategyInterface $encoder
    ) {
        $this->userRepository = $userRepository;
        $this->encoder = $encoder;
    }

    public function execute($dto)
    {
        if (!($dto->user instanceof User)) {
            throw new LogicException('Incorrect object. Need '.User::class);
        }
        if (!($dto->userDTO instanceof UserDTO)) {
            throw new LogicException('Incorrect object. Need '.UserDTO::class);
        }

        if ($dto->userDTO->fullName) {
            $dto->user->updateFullName($dto->userDTO->fullName);
        }

        $this->userRepository->addAndSave($dto->user);

        return $dto->user;
    }
}
