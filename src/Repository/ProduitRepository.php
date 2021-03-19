<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    public function findBySearch($search): ?array
    {
        return $this->createQueryBuilder('p')
            ->where('p.nomProduit LIKE \'%'.$search.'%\'')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Produit[] Returns an array of Produit objects
     */
    public function findProduitsByCategorie(int $id)
    {
        $entityManager = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT p.id, p.sous_categorie_produit_id, p.nom_produit, p.prix_unitaire_ht, p.taux_tva, p.presentation, p.description_detaillee, p.image, cp.id, cp.nom, scp.nom
            FROM produit p
            INNER JOIN sous_categorie_produit scp ON p.sous_categorie_produit_id = scp.id
            INNER JOIN categorie_produit cp ON scp.categorie_produit_id = cp.id
            WHERE cp.id = @id
        ';
        $sql = str_replace('@id', $id, $sql); // On remplace le @id par la valeur de $id en PHP

        $stmt = $entityManager->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * @return Produit[] Returns an array of Produit objects
     */
    public function findProduitsBySousCategorie(int $id)
    {
        $entityManager = $this->getEntityManager()->getConnection();
        $sql = '
            SELECT p.id, p.sous_categorie_produit_id, p.nom_produit, p.prix_unitaire_ht, p.taux_tva, p.presentation, p.description_detaillee, p.image, scp.id, scp.nom
            FROM produit p
            INNER JOIN sous_categorie_produit scp ON p.sous_categorie_produit_id = scp.id
            WHERE scp.id = @id
        ';
        $sql = str_replace('@id', $id, $sql); // On remplace le @id par la valeur de $id en PHP

        $stmt = $entityManager->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    // /**
    //  * @return Produit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
