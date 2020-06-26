<?php

namespace App\Repository;

use App\Entity\LigneEngagement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LigneEngagement|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneEngagement|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneEngagement[]    findAll()
 * @method LigneEngagement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneEngagementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneEngagement::class);
    }

    // /**
    //  * @return LigneEngagement[] Returns an array of LigneEngagement objects
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
    public function findOneBySomeField($value): ?LigneEngagement
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
