<?php

namespace CoreDomain\Infrastructure\Mail;

use CoreDomain\Model\Password;
use CoreDomain\Model\User;

interface MessengerInterface
{
    public function sendResettingEmailMessage(User $user, Password $password);
}
