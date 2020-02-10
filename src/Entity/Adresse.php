<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

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
     * @ORM\Column(type="string", length=45)
     */
    private $typeRue;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nomRue;

    /**
     * @ORM\Column(type="integer")
     */
    private $CP;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Ville;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="Adresse")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Utilisateur;

    public function __construct()
    {
        $this->utilisateurEntreprises = new ArrayCollection();
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

    /**
     * @return Collection|UtilisateurEntreprise[]
     */
    public function getUtilisateurEntreprises(): Collection
    {
        return $this->utilisateurEntreprises;
    }

    public function addUtilisateurEntreprise(UtilisateurEntreprise $utilisateurEntreprise): self
    {
        if (!$this->utilisateurEntreprises->contains($utilisateurEntreprise)) {
            $this->utilisateurEntreprises[] = $utilisateurEntreprise;
            $utilisateurEntreprise->setIdAdresse($this);
        }

        return $this;
    }

    public function removeUtilisateurEntreprise(UtilisateurEntreprise $utilisateurEntreprise): self
    {
        if ($this->utilisateurEntreprises->contains($utilisateurEntreprise)) {
            $this->utilisateurEntreprises->removeElement($utilisateurEntreprise);
            // set the owning side to null (unless already changed)
            if ($utilisateurEntreprise->getIdAdresse() === $this) {
                $utilisateurEntreprise->setIdAdresse(null);
            }
        }

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
