<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ObjetCollecteRepository")
 */
class ObjetCollecte
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieCollecte", inversedBy="objetCollectes")
     */
    private $CategorieCollecte;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Devis", inversedBy="ObjectCollecte")
     */
    private $devis;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getquantite(): ?int
    {
        return $this->quantite;
    }

    public function setquantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getIdcategorieCollecte(): ?CategorieCollecte
    {
        return $this->idcategorieCollecte;
    }

    public function setIdcategorieCollecte(?CategorieCollecte $idcategorieCollecte): self
    {
        $this->idcategorieCollecte = $idcategorieCollecte;

        return $this;
    }

    public function getDevis(): ?Devis
    {
        return $this->devis;
    }

    public function setDevis(?Devis $devis): self
    {
        $this->devis = $devis;

        return $this;
    }

    public function getCategorieCollecte(): ?CategorieCollecte
    {
        return $this->CategorieCollecte;
    }

    public function setCategorieCollecte(?CategorieCollecte $CategorieCollecte): self
    {
        $this->CategorieCollecte = $CategorieCollecte;

        return $this;
    }

    public function getNom(): ?int
    {
        return $this->nom;
    }

    public function setNom(int $nom): self
    {
        $this->nom = $nom;

        return $this;
    }
}
