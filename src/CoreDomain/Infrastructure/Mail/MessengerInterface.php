<?php

namespace CoreDomain\Infrastructure\Mail;

use AppBundle\Entity\Order;
use CoreDomain\Model\User;

interface MessengerInterface
{
    public function sendPostUserRegistration(User $user);
    public function sendResettingEmailMessage(User $user);
    public function sendPostOrderCreate(Order $order);
}
