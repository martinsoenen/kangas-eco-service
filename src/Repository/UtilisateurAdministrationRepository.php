<?php

namespace App\Repository;

use App\Entity\UtilisateurAdministration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UtilisateurAdministration|null find($id, $lockMode = null, $lockVersion = null)
 * @method UtilisateurAdministration|null findOneBy(array $criteria, array $orderBy = null)
 * @method UtilisateurAdministration[]    findAll()
 * @method UtilisateurAdministration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurAdministrationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UtilisateurAdministration::class);
    }

    // /**
    //  * @return UtilisateurAdministration[] Returns an array of UtilisateurAdministration objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UtilisateurAdministration
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
