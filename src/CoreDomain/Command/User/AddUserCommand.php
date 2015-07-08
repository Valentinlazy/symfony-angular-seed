<?php

namespace CoreDomain\Command\User;

use CoreDomain\Command\CommandInterface;
use CoreDomain\DTO\UserDTO;
use CoreDomain\Exception\LogicException;
use CoreDomain\Exception\ValidationException;
use CoreDomain\Model\User;
use CoreDomain\Model\Password;

class AddUserCommand implements CommandInterface
{
    private $repository;
    private $encoder;
    private $validator;

    public function __construct (
        \CoreDomain\Repository\UserRepositoryInterface $repository,
        \CoreDomain\Security\PasswordStrategyInterface $encoder,
        \Symfony\Component\Validator\Validator\RecursiveValidator $validator
    ) {
        $this->repository = $repository;
        $this->encoder = $encoder;
        $this->validator = $validator;
    }

    public function execute($dto)
    {
        if (!($dto instanceof UserDTO)) {
            throw new LogicException('Incorrect DTO. Need '.UserDTO::class);
        }

        $user = new User($dto->email, new Password($this->encoder, $dto->password), $dto->fullName);

        if (count($validationErrors = $this->validator->validate($user)) > 0) {
            throw new ValidationException('Bad request', $validationErrors);
        }

        $this->repository->addAndSave($user);

        return $user;
    }
}