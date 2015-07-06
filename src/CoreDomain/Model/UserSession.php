<?php
namespace CoreDomain\Model;

class UserSession
{
    private $id;

    private $user;

    private $token;

    private $createdAt;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->token = $this->generateToken();
        $this->createdAt = new \DateTime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function getUserId()
    {
        return $this->user->getId();
    }

    private function generateToken()
    {
        return base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
    }
}