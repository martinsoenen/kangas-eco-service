<?php

namespace App\Entity;

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
    private $idUtilisateurAdmin;

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
}
