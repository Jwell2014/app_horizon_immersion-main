<?php

namespace App\Repository;

use App\Entity\EnigmeUn;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnigmeUn|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnigmeUn|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnigmeUn[]    findAll()
 * @method EnigmeUn[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnigmeUnRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnigmeUn::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(EnigmeUn $entity, bool $flush = true): void
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
    public function remove(EnigmeUn $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return EnigmeUn[] Returns an array of EnigmeUn objects
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
    public function findOneBySomeField($value): ?EnigmeUn
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAllAnswers()
    {
        return $this->createQueryBuilder('e')
            ->select('e.answer')
            ->getQuery()
            ->getResult()
            ;
    }
}
