<?php

namespace CoreDomain\Command\User;

use CoreDomain\Command\CommandInterface;
use CoreDomain\DTO\ProfileDTO;
use CoreDomain\Exception\LogicException;
use CoreDomain\Exception\ValidationException;
use CoreDomain\Model\Password;
use CoreDomain\Model\User;

class UpdateProfileCommand implements CommandInterface
{
    private $repository;
    private $encoder;
    private $validator;

    public function __construct(
        \CoreDomain\Repository\UserRepositoryInterface $userRepository,
        \CoreDomain\Security\PasswordStrategyInterface $encoder,
        \Symfony\Component\Validator\Validator\RecursiveValidator $validator
    ) {
        $this->repository = $userRepository;
        $this->encoder = $encoder;
        $this->validator = $validator;
    }

    public function execute($dto)
    {
        if (!($dto->user instanceof User)) {
            throw new LogicException('Incorrect object. Need '.User::class);
        }
        if (!($dto->profileDTO instanceof ProfileDTO)) {
            throw new LogicException('Incorrect object. Need '.ProfileDTO::class);
        }

        if ($dto->profileDTO->password) {
            $dto->user->changePassword(new Password($this->encoder, $dto->profileDTO->password));
        }
        $dto->user->updateProfile($dto->profileDTO);

        if (count($validationErrors = $this->validator->validate($dto->user)) > 0) {
            throw new ValidationException('Bad request', $validationErrors);
        }

        $this->repository->addAndSave($dto->user);

        return $dto->user;
    }
}
