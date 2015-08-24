<?php

namespace CoreDomain\Command;

interface CommandInterface
{
    public function execute($dto);
}
