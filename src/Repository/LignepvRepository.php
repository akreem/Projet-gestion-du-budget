<?php

namespace App\Repository;

use App\Entity\Lignepv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Lignepv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lignepv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lignepv[]    findAll()
 * @method Lignepv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LignepvRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lignepv::class);
    }

    // /**
    //  * @return Lignepv[] Returns an array of Lignepv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Lignepv
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
