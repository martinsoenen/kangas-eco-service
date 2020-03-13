<?php

namespace App\Repository;

use App\Entity\SousCategorieProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SousCategorieProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method SousCategorieProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method SousCategorieProduit[]    findAll()
 * @method SousCategorieProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SousCategorieProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SousCategorieProduit::class);
    }
}
