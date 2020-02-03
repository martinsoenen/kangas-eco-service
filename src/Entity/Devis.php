<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DevisRepository")
 */
class Devis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $localite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ObjetCollecte", mappedBy="devis")
     */
    private $idObjectCollecte;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CategorieCollecte", mappedBy="devis")
     */
    private $relation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilisateurEntreprise", inversedBy="devis")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilisateur;

    public function __construct()
    {
        $this->idObjectCollecte = new ArrayCollection();
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocalite(): ?string
    {
        return $this->localite;
    }

    public function setLocalite(?string $localite): self
    {
        $this->localite = $localite;

        return $this;
    }

    /**
     * @return Collection|ObjetCollecte[]
     */
    public function getIdObjectCollecte(): Collection
    {
        return $this->idObjectCollecte;
    }

    public function addIdObjectCollecte(ObjetCollecte $idObjectCollecte): self
    {
        if (!$this->idObjectCollecte->contains($idObjectCollecte)) {
            $this->idObjectCollecte[] = $idObjectCollecte;
            $idObjectCollecte->setDevis($this);
        }

        return $this;
    }

    public function removeIdObjectCollecte(ObjetCollecte $idObjectCollecte): self
    {
        if ($this->idObjectCollecte->contains($idObjectCollecte)) {
            $this->idObjectCollecte->removeElement($idObjectCollecte);
            // set the owning side to null (unless already changed)
            if ($idObjectCollecte->getDevis() === $this) {
                $idObjectCollecte->setDevis(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CategorieCollecte[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(CategorieCollecte $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
            $relation->setDevis($this);
        }

        return $this;
    }

    public function removeRelation(CategorieCollecte $relation): self
    {
        if ($this->relation->contains($relation)) {
            $this->relation->removeElement($relation);
            // set the owning side to null (unless already changed)
            if ($relation->getDevis() === $this) {
                $relation->setDevis(null);
            }
        }

        return $this;
    }

    public function getIdUtilisateur(): ?UtilisateurEntreprise
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(?UtilisateurEntreprise $idUtilisateur): self
    {
        $this->idUtilisateur = $idUtilisateur;

        return $this;
    }

    public function getUtilisateur(): ?UtilisateurEntreprise
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?UtilisateurEntreprise $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }
}
