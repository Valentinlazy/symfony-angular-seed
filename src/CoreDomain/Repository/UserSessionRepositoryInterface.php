<?php

namespace CoreDomain\Repository;

use CoreDomain\Model\UserSession;

interface UserSessionRepositoryInterface
{
    public function addAndSave(UserSession $session);
}