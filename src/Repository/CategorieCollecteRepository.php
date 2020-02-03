<?php

namespace App\Repository;

use App\Entity\CategorieCollecte;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategorieCollecte|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieCollecte|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieCollecte[]    findAll()
 * @method CategorieCollecte[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieCollecteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieCollecte::class);
    }

    // /**
    //  * @return CategorieCollecte[] Returns an array of CategorieCollecte objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategorieCollecte
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
