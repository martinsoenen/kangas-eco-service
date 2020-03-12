<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\AdresseRepository")
 */
class Adresse
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
     * @ORM\Column(type="integer")
     */
    private $numeroRue;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $typeRue;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nomRue;

    /**
     * @Assert\Length(
     *   min = 5,
     *   minMessage="Veuillez saisir un code postal valide",
     * )
     *  @Assert\Length(
     *   max = 5,
     *   maxMessage="Veuillez saisir un code postal valide",
     * )
     * @ORM\Column(type="integer")
     */
    private $CP;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Ville;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="Adresse",cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilisateur;

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

    public function getNumeroRue(): ?int
    {
        return $this->numeroRue;
    }

    public function setNumeroRue(int $numeroRue): self
    {
        $this->numeroRue = $numeroRue;

        return $this;
    }

    public function getTypeRue(): ?string
    {
        return $this->typeRue;
    }

    public function setTypeRue(string $typeRue): self
    {
        $this->typeRue = $typeRue;

        return $this;
    }

    public function getNomRue(): ?string
    {
        return $this->nomRue;
    }

    public function setNomRue(string $nomRue): self
    {
        $this->nomRue = $nomRue;

        return $this;
    }

    public function getCP(): ?int
    {
        return $this->CP;
    }

    public function setCP(int $CP): self
    {
        $this->CP = $CP;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->Utilisateur;
    }

    public function setUtilisateur(?Utilisateur $Utilisateur): self
    {
        $this->Utilisateur = $Utilisateur;

        return $this;
    }

    
}
