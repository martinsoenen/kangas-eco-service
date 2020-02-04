<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieProduitRepository")
 */
class CategorieProduit
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
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilisateurAdministration")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UtilisateurAdmin;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SousCategorieProduit", mappedBy="idCategorieProduit")
     */
    private $sousCategorieProduits;

    public function __construct()
    {
        $this->sousCategorieProduits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getIdUtilisateurAdmin(): ?UtilisateurAdministration
    {
        return $this->idUtilisateurAdmin;
    }

    public function setIdUtilisateurAdmin(?UtilisateurAdministration $idUtilisateurAdmin): self
    {
        $this->idUtilisateurAdmin = $idUtilisateurAdmin;

        return $this;
    }

    public function getUtilisateurAdmin(): ?UtilisateurAdministration
    {
        return $this->UtilisateurAdmin;
    }

    public function setUtilisateurAdmin(?UtilisateurAdministration $UtilisateurAdmin): self
    {
        $this->UtilisateurAdmin = $UtilisateurAdmin;

        return $this;
    }

    /**
     * @return Collection|SousCategorieProduit[]
     */
    public function getSousCategorieProduits(): Collection
    {
        return $this->sousCategorieProduits;
    }

    public function addSousCategorieProduit(SousCategorieProduit $sousCategorieProduit): self
    {
        if (!$this->sousCategorieProduits->contains($sousCategorieProduit)) {
            $this->sousCategorieProduits[] = $sousCategorieProduit;
            $sousCategorieProduit->setIdCategorieProduit($this);
        }

        return $this;
    }

    public function removeSousCategorieProduit(SousCategorieProduit $sousCategorieProduit): self
    {
        if ($this->sousCategorieProduits->contains($sousCategorieProduit)) {
            $this->sousCategorieProduits->removeElement($sousCategorieProduit);
            // set the owning side to null (unless already changed)
            if ($sousCategorieProduit->getIdCategorieProduit() === $this) {
                $sousCategorieProduit->setIdCategorieProduit(null);
            }
        }

        return $this;
    }
}
