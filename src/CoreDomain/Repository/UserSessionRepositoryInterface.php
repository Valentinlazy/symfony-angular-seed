<?php

namespace CoreDomain\Repository;

use CoreDomain\Model\UserSession;

interface UserSessionRepositoryInterface
{
    public function findUserByToken($token, $expirePeriod = 'PT7d');
    public function addAndSave(UserSession $session);
}