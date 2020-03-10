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
    private $Produit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $PayPalID;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    public function __construct()
    {
        $this->Produit = new ArrayCollection();
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
    public function getProduit(): Collection
    {
        return $this->Produit;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->Produit->contains($produit)) {
            $this->Produit[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        if ($this->Produit->contains($produit)) {
            $this->Produit->removeElement($produit);
        }

        return $this;
    }

    public function getPayPalID(): ?string
    {
        return $this->PayPalID;
    }

    public function setPayPalID(string $PayPalID): self
    {
        $this->PayPalID = $PayPalID;

        return $this;
    }

    public function getUser(): ?Utilisateur
    {
        return $this->User;
    }

    public function setUser(?Utilisateur $User): self
    {
        $this->User = $User;

        return $this;
    }
}
