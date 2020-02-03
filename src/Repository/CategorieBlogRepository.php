<?php

namespace App\Repository;

use App\Entity\CategorieBlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CategorieBlog|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategorieBlog|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategorieBlog[]    findAll()
 * @method CategorieBlog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategorieBlogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategorieBlog::class);
    }

    // /**
    //  * @return CategorieBlog[] Returns an array of CategorieBlog objects
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
    public function findOneBySomeField($value): ?CategorieBlog
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
