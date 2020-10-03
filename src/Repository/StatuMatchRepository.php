<?php

namespace App\Repository;

use App\Entity\StatuMatch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StatuMatch|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatuMatch|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatuMatch[]    findAll()
 * @method StatuMatch[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatuMatchRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatuMatch::class);
    }

    // /**
    //  * @return StatuMatch[] Returns an array of StatuMatch objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StatuMatch
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
