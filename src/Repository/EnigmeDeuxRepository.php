<?php

namespace App\Repository;

use App\Entity\EnigmeDeux;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnigmeDeux|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnigmeDeux|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnigmeDeux[]    findAll()
 * @method EnigmeDeux[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnigmeDeuxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnigmeDeux::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(EnigmeDeux $entity, bool $flush = true): void
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
    public function remove(EnigmeDeux $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return EnigmeDeux[] Returns an array of EnigmeDeux objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EnigmeDeux
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
