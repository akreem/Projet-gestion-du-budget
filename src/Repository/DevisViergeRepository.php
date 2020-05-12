<?php

namespace App\Repository;

use App\Entity\DevisVierge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method DevisVierge|null find($id, $lockMode = null, $lockVersion = null)
 * @method DevisVierge|null findOneBy(array $criteria, array $orderBy = null)
 * @method DevisVierge[]    findAll()
 * @method DevisVierge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevisViergeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DevisVierge::class);
    }

    // /**
    //  * @return DevisVierge[] Returns an array of DevisVierge objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DevisVierge
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
