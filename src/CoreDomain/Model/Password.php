<?php

namespace CoreDomain\Model;

use CoreDomain\Security\PasswordStrategyInterface;

class Password
{
    const PASSWORD_LENGTH = 10;
    const SALT_LENGTH = 32;

    private $plainPassword;

    private $salt;

    private $encoder;

    public function __construct(PasswordStrategyInterface $encoder, $password)
    {
        $this->encoder = $encoder;
        $this->plainPassword = $password;
        $this->generateSalt();
    }

    public function getPassword()
    {
        return $this->encoder->getEncodedPassword($this->plainPassword, $this->salt);
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function generatePassword($length = self::PASSWORD_LENGTH)
    {
        $this->plainPassword = $this->generateString($length);
        return $this;
    }

    private function generateSalt()
    {
        $this->salt = $this->generateString(self::SALT_LENGTH);
        return $this;
    }

    private function generateString($length)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+?";
        return substr(str_shuffle($chars), 0, $length);

    }
}