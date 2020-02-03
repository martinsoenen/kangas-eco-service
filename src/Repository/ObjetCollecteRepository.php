<?php

namespace App\Repository;

use App\Entity\ObjetCollecte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ObjetCollecte|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjetCollecte|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjetCollecte[]    findAll()
 * @method ObjetCollecte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjetCollecteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObjetCollecte::class);
    }

    // /**
    //  * @return ObjetCollecte[] Returns an array of ObjetCollecte objects
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
    public function findOneBySomeField($value): ?ObjetCollecte
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
