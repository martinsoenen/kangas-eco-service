<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SousCategorieProduitRepository")
 */
class SousCategorieProduit
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
     * @ORM\ManyToOne(targetEntity="App\Entity\CategorieProduit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategorieProduit;

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

    public function getIdCategorieProduit(): ?CategorieProduit
    {
        return $this->idCategorieProduit;
    }

    public function setIdCategorieProduit(?CategorieProduit $idCategorieProduit): self
    {
        $this->idCategorieProduit = $idCategorieProduit;

        return $this;
    }

    public function getCategorieProduit(): ?CategorieProduit
    {
        return $this->CategorieProduit;
    }

    public function setCategorieProduit(?CategorieProduit $CategorieProduit): self
    {
        $this->CategorieProduit = $CategorieProduit;

        return $this;
    }
}
