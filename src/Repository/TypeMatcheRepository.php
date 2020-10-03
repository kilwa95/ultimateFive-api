<?php

namespace App\Repository;

use App\Entity\TypeMatche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeMatche|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeMatche|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeMatche[]    findAll()
 * @method TypeMatche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeMatcheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeMatche::class);
    }

    // /**
    //  * @return TypeMatche[] Returns an array of TypeMatche objects
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
    public function findOneBySomeField($value): ?TypeMatche
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
