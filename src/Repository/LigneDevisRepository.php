<?php

namespace App\Repository;

use App\Entity\LigneDevis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LigneDevis|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneDevis|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneDevis[]    findAll()
 * @method LigneDevis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneDevisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneDevis::class);
    }

    // /**
    //  * @return LigneDevis[] Returns an array of LigneDevis objects
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
    public function findOneBySomeField($value): ?LigneDevis
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
