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

    public function findUserByToken($token, $expirePeriod = 'PT7d')
    {
        $validCreatedAt = new \DateTime();
        $validCreatedAt->sub(new \DateInterval($expirePeriod));

        return $this->em->createQueryBuilder()
            ->select('s.user')
            ->from(UserSession::class, 's')
            ->where('s.token = :token')
            ->andWhere('s.createdAt > :date')
            ->setParameter('token', $token)
            ->setParameter('date', $validCreatedAt)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function addAndSave(UserSession $session)
    {
        $this->em->persist($session);
        $this->em->flush($session);
    }
}