<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use CoreDomain\Model\UserSession;
use CoreDomain\Repository\UserSessionRepositoryInterface;

class UserSessionRepository implements UserSessionRepositoryInterface
{
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function addAndSave(UserSession $session)
    {
        $this->em->persist($session);
        $this->em->flush($session);
    }
}