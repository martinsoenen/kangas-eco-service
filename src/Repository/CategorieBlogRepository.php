<?php

namespace App\Repository;

use App\Entity\CategorieBlog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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
}
