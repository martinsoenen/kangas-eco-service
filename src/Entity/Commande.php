<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CommandeRepository")
 */
class Commande
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbArticles;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montantTVA;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $montantHT;

    /**
     * @ORM\Column(type="float")
     */
    private $montantTotalTTC;

    /**
     * @ORM\Column(type="smallint")
     */
    private $isSend;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Produit")
     */
    private $idProduit;

    public function __construct()
    {
        $this->idProduit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNbArticles(): ?int
    {
        return $this->nbArticles;
    }

    public function setNbArticles(int $nbArticles): self
    {
        $this->nbArticles = $nbArticles;

        return $this;
    }

    public function getMontantTVA(): ?float
    {
        return $this->montantTVA;
    }

    public function setMontantTVA(?float $montantTVA): self
    {
        $this->montantTVA = $montantTVA;

        return $this;
    }

    public function getMontantHT(): ?float
    {
        return $this->montantHT;
    }

    public function setMontantHT(?float $montantHT): self
    {
        $this->montantHT = $montantHT;

        return $this;
    }

    public function getMontantTotalTTC(): ?float
    {
        return $this->montantTotalTTC;
    }

    public function setMontantTotalTTC(float $montantTotalTTC): self
    {
        $this->montantTotalTTC = $montantTotalTTC;

        return $this;
    }

    public function getIsSend(): ?int
    {
        return $this->isSend;
    }

    public function setIsSend(int $isSend): self
    {
        $this->isSend = $isSend;

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getIdProduit(): Collection
    {
        return $this->idProduit;
    }

    public function addIdProduit(Produit $idProduit): self
    {
        if (!$this->idProduit->contains($idProduit)) {
            $this->idProduit[] = $idProduit;
        }

        return $this;
    }

    public function removeIdProduit(Produit $idProduit): self
    {
        if ($this->idProduit->contains($idProduit)) {
            $this->idProduit->removeElement($idProduit);
        }

        return $this;
    }
}
