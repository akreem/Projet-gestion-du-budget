<?php

namespace App\Repository;

use App\Entity\TabRecap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TabRecap|null find($id, $lockMode = null, $lockVersion = null)
 * @method TabRecap|null findOneBy(array $criteria, array $orderBy = null)
 * @method TabRecap[]    findAll()
 * @method TabRecap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TabRecapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TabRecap::class);
    }

    // /**
    //  * @return TabRecap[] Returns an array of TabRecap objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TabRecap
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
