<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use CoreDomain\Model\UserSession;
use CoreDomain\Repository\UserRepositoryInterface;
use CoreDomain\Model\User;

class UserRepository implements UserRepositoryInterface
{
    private $em;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $email
     * @return User
     */
    public function findOneByEmail($email)
    {
        return $this->em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneById($id)
    {
        return $this->em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneByToken($token, $expirePeriod = 'P7D')
    {
        $validCreatedAt = new \DateTime();
        $validCreatedAt->sub(new \DateInterval($expirePeriod));

        return $this->em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->innerJoin('u.sessions', 's')
            ->where('s.token = :token')
            ->andWhere('s.createdAt > :date')
            ->setParameter('token', $token)
            ->setParameter('date', $validCreatedAt)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /*public function findUserByConfirmationToken($token)
    {
        return $this->em->createQueryBuilder()
            ->select('u')
            ->from(User::class, 'u')
            ->where('u.confirmationToken = :token')
            ->setParameter('token', $token)
            ->getQuery()
            ->getOneOrNullResult();
    }*/

    /**
     * @param User $user
     */
    public function add(User $user)
    {
        $this->em->persist($user);
    }

    public function addAndSave(User $user)
    {
        $this->em->persist($user);
        $this->em->flush($user);
    }

    /**
     * @param User $user
     */
    public function remove(User $user)
    {
        $this->em->remove($user);
    }
}
