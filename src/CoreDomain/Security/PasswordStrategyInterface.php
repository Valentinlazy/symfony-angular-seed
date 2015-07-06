<?php

namespace CoreDomain\Security;

interface PasswordStrategyInterface
{
    public function getEncodedPassword($plainPassword, $salt);
    public function isPasswordValid($plainPassword, $encoded, $salt);
}