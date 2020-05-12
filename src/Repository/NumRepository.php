<?php

namespace App\Repository;

use App\Entity\Num;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Num|null find($id, $lockMode = null, $lockVersion = null)
 * @method Num|null findOneBy(array $criteria, array $orderBy = null)
 * @method Num[]    findAll()
 * @method Num[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Num::class);
    }

    // /**
    //  * @return Num[] Returns an array of Num objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Num
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
