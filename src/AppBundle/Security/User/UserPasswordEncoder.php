<?php

namespace AppBundle\Security\User;

use CoreDomain\Security\PasswordStrategyInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserPasswordEncoder implements PasswordStrategyInterface
{
    private $encoderFactory;
    private $encoder;

    public function __construct(EncoderFactoryInterface $encoderFactory, $class)
    {
        $this->encoderFactory = $encoderFactory;
        $this->encoder = $this->encoderFactory->getEncoder($class);
    }

    public function getEncodedPassword($plainPassword, $salt)
    {
        return $this->encoder->encodePassword($plainPassword, $salt);
    }

    public function isPasswordValid($plainPassword, $encoded, $salt)
    {
        return $this->encoder->isPasswordValid($encoded, $plainPassword, $salt);
    }
}