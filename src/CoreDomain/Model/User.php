<?php

namespace CoreDomain\Model;

use CoreDomain\DTO\ProfileDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

class User implements AdvancedUserInterface
{
    private $id;
    private $email;
    private $password;

    private $salt;
    private $roles;
    private $sessions;
    private $fullName;
    private $phone;

    public function __construct($email, Password $password, array $roles = ['ROLE_USER'])
    {
        $this->email = $email;
        $this->password = $password->getPassword();
        $this->salt = $password->getSalt();
        $this->roles = $roles;
        $this->sessions = new ArrayCollection();
    }

    public function login()
    {
        return new UserSession($this);
    }

    public function changePassword(Password $password)
    {
        $this->password = $password->getPassword();
        $this->salt = $password->getSalt();
    }

    public function updateProfile(ProfileDTO $dto)
    {
        $this->fullName = $dto->fullName;
        $this->phone = $dto->phone;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return true;
    }

    public function eraseCredentials()
    {

    }

    public function getFullName()
    {
        return $this->fullName;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @return ArrayCollection
     */
    public function getSessions()
    {
        return $this->sessions;
    }
}
