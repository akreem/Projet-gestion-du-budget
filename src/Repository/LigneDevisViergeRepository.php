<?php

namespace App\Repository;

use App\Entity\LigneDevisVierge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LigneDevisVierge|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneDevisVierge|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneDevisVierge[]    findAll()
 * @method LigneDevisVierge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneDevisViergeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneDevisVierge::class);
    }

    // /**
    //  * @return LigneDevisVierge[] Returns an array of LigneDevisVierge objects
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
    public function findOneBySomeField($value): ?LigneDevisVierge
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
