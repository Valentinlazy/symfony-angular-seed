<?php

namespace CoreDomain\Repository;

use CoreDomain\Model\User;

interface UserRepositoryInterface
{
    /** @return \CoreDomain\Model\User */
    public function findOneByEmail($email);
    public function findOneById($id);
    public function findOneByToken($token);
    //public function findOneByConfirmationToken($token);

    public function add(User $user);
    public function addAndSave(User $user);
    public function remove(User $user);
}
