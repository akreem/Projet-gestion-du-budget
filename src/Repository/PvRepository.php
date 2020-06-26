<?php

namespace App\Repository;

use App\Entity\Pv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pv[]    findAll()
 * @method Pv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pv::class);
    }

    // /**
    //  * @return Pv[] Returns an array of Pv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pv
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
