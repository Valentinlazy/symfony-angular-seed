<?php

namespace CoreDomain\Handler;

use CoreDomain\Command\CommandInterface;

class CommandHandler
{
    public function run(CommandInterface $command, $dto)
    {
        return $command->execute($dto);
    }
}