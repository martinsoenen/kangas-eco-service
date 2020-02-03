<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieCollecteRepository")
 */
class CategorieCollecte
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
     * @ORM\OneToMany(targetEntity="App\Entity\ObjetCollecte", mappedBy="idcategorieCollecte")
     */
    private $objetCollectes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Devis", inversedBy="relation")
     */
    private $devis;

    public function __construct()
    {
        $this->objetCollectes = new ArrayCollection();
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

    /**
     * @return Collection|ObjetCollecte[]
     */
    public function getObjetCollectes(): Collection
    {
        return $this->objetCollectes;
    }

    public function addObjetCollecte(ObjetCollecte $objetCollecte): self
    {
        if (!$this->objetCollectes->contains($objetCollecte)) {
            $this->objetCollectes[] = $objetCollecte;
            $objetCollecte->setIdcategorieCollecte($this);
        }

        return $this;
    }

    public function removeObjetCollecte(ObjetCollecte $objetCollecte): self
    {
        if ($this->objetCollectes->contains($objetCollecte)) {
            $this->objetCollectes->removeElement($objetCollecte);
            // set the owning side to null (unless already changed)
            if ($objetCollecte->getIdcategorieCollecte() === $this) {
                $objetCollecte->setIdcategorieCollecte(null);
            }
        }

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
}
