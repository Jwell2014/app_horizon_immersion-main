<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(User $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(User $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */

    public function findByAgentRole($role)
    {
        return $this->createQueryBuilder('u')
            ->where('u.roles LIKE :role')
            ->setParameter('role', '%"'.'ROLE_AGENT'.'"%')
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByParticipantRole($role)
    {
        return $this->createQueryBuilder('u')
            ->where('u.roles LIKE :role')
            ->setParameter('role', '%"'.'ROLE_PARTICIPANT'.'"%')
            ->getQuery()
            ->getResult()
        ;
    }



    public function findByRoleAgent($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.roles LIKE :val')
            ->setParameter('val', "%ROLE_AGENT%")
            ->getQuery()
            ->getResult();
    }

    public function findUserBySession()
    {
        return $this->createQueryBuilder('u')
            ->select('u')
            ->leftJoin('App\Entity\Sessions', 's', 'WITH', 'u.session_id = s.id')
//            ->groupBy('u.session_id')
            ->getQuery()
            ->getResult();
    }

}
