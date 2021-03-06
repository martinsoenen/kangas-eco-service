<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nomProduit;

    /**
     * @ORM\Column(type="float")
     */
    private $prixUnitaireHT;

    /**
     * @ORM\Column(type="float")
     */
    private $tauxTVA;

    /**
     * @ORM\Column(type="string")
     */
    private $presentation;

    /**
     * @ORM\Column(type="text")
     */
    private $descriptionDetaillee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SousCategorieProduit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $SousCategorieProduit;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getPrixUnitaireHT(): ?float
    {
        return $this->prixUnitaireHT;
    }

    public function setPrixUnitaireHT(float $prixUnitaireHT): self
    {
        $this->prixUnitaireHT = $prixUnitaireHT;

        return $this;
    }

    public function getTauxTVA(): ?float
    {
        return $this->tauxTVA;
    }

    public function setTauxTVA(float $tauxTVA): self
    {
        $this->tauxTVA = $tauxTVA;

        return $this;
    }

    public function getPresentation(): ?string
    {
        return $this->presentation;
    }

    public function setPresentation(string $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getDescriptionDetaillee(): ?string
    {
        return $this->descriptionDetaillee;
    }

    public function setDescriptionDetaillee(string $descriptionDetaillee): self
    {
        $this->descriptionDetaillee = $descriptionDetaillee;

        return $this;
    }

    public function getIdSousCategorieProduit(): ?SousCategorieProduit
    {
        return $this->idSousCategorieProduit;
    }

    public function setIdSousCategorieProduit(?SousCategorieProduit $idSousCategorieProduit): self
    {
        $this->idSousCategorieProduit = $idSousCategorieProduit;

        return $this;
    }


    public function getSousCategorieProduit(): ?SousCategorieProduit
    {
        return $this->SousCategorieProduit;
    }

    public function setSousCategorieProduit(?SousCategorieProduit $SousCategorieProduit): self
    {
        $this->SousCategorieProduit = $SousCategorieProduit;

        return $this;
    }


    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
