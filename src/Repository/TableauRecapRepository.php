<?php

namespace App\Repository;

use App\Entity\TableauRecap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TableauRecap|null find($id, $lockMode = null, $lockVersion = null)
 * @method TableauRecap|null findOneBy(array $criteria, array $orderBy = null)
 * @method TableauRecap[]    findAll()
 * @method TableauRecap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TableauRecapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TableauRecap::class);
    }

    // /**
    //  * @return TableauRecap[] Returns an array of TableauRecap objects
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
    public function findOneBySomeField($value): ?TableauRecap
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
