<?php

namespace App\Repository;

use App\Entity\Ordrepayement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ordrepayement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ordrepayement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ordrepayement[]    findAll()
 * @method Ordrepayement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdrepayementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ordrepayement::class);
    }

    // /**
    //  * @return Ordrepayement[] Returns an array of Ordrepayement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ordrepayement
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
