<?php

namespace App\Repository;

use App\Entity\Adresse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Adresse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adresse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adresse[]    findAll()
 * @method Adresse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdresseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adresse::class);
    }

      public function getAdresseById($id){
        return $this->createQueryBuilder('a') 
            ->leftJoin('a.Utilisateur','adr')
            ->addSelect('adr')           
            ->andWhere('a.Utilisateur = :val')
            ->setParameter('val', $id)           
            ->getQuery()
            ->getResult();
    }
}
