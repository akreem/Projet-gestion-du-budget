<?php

namespace App\Repository;

use App\Entity\BonCommande;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BonCommande|null find($id, $lockMode = null, $lockVersion = null)
 * @method BonCommande|null findOneBy(array $criteria, array $orderBy = null)
 * @method BonCommande[]    findAll()
 * @method BonCommande[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BonCommandeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BonCommande::class);
    }

    // /**
    //  * @return BonCommande[] Returns an array of BonCommande objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BonCommande
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
