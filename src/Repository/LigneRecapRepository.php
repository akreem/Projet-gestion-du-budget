<?php

namespace App\Repository;

use App\Entity\LigneRecap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method LigneRecap|null find($id, $lockMode = null, $lockVersion = null)
 * @method LigneRecap|null findOneBy(array $criteria, array $orderBy = null)
 * @method LigneRecap[]    findAll()
 * @method LigneRecap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LigneRecapRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LigneRecap::class);
    }

     /**
      * @return LigneRecap[] Returns an array of LigneRecap objects
      */

    public function findListeFournisseur($idtr)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.TableauRecap = :tr')
            ->setParameter('tr', $idtr)
            ->groupBy('l.nomfournisseur')
            ->getQuery()
            ->getResult()
        ;
    }



    /*
    public function findOneBySomeField($value): ?LigneRecap
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
