<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 */
class Utilisateur
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $tokenPassword;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $raisonSociale;

    /**
     * @ORM\Column(type="string", length=40, nullable=true)
     */
    private $utilisateurType;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="utilisateur", orphanRemoval=true)
     */
    private $Adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="Utilisateur", orphanRemoval=true)
     */
    private $devis;

    public function __construct()
    {
        $this->idAdresse = new ArrayCollection();
        $this->Adresse = new ArrayCollection();
        $this->devis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTokenPassword(): ?string
    {
        return $this->token_password;
    }

    public function setTokenPassword(?string $token_password): self
    {
        $this->token_password = $token_password;

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getIdAdresse(): Collection
    {
        return $this->idAdresse;
    }

    public function addIdAdresse(Adresse $idAdresse): self
    {
        if (!$this->idAdresse->contains($idAdresse)) {
            $this->idAdresse[] = $idAdresse;
            $idAdresse->setUtilisateur($this);
        }

        return $this;
    }

    public function removeIdAdresse(Adresse $idAdresse): self
    {
        if ($this->idAdresse->contains($idAdresse)) {
            $this->idAdresse->removeElement($idAdresse);
            // set the owning side to null (unless already changed)
            if ($idAdresse->getUtilisateur() === $this) {
                $idAdresse->setUtilisateur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresse(): Collection
    {
        return $this->Adresse;
    }

    public function addAdresse(Adresse $adresse): self
    {
        if (!$this->Adresse->contains($adresse)) {
            $this->Adresse[] = $adresse;
            $adresse->setUtilisateur($this);
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): self
    {
        if ($this->Adresse->contains($adresse)) {
            $this->Adresse->removeElement($adresse);
            // set the owning side to null (unless already changed)
            if ($adresse->getUtilisateur() === $this) {
                $adresse->setUtilisateur(null);
            }
        }

        return $this;
    }

    public function getRaisonSociale(): ?string
    {
        return $this->raisonSociale;
    }

    public function setRaisonSociale(?string $raisonSociale): self
    {
        $this->raisonSociale = $raisonSociale;

        return $this;
    }

    public function getUtilisateurType(): ?string
    {
        return $this->utilisateurType;
    }

    public function setUtilisateurType(?string $utilisateurType): self
    {
        $this->utilisateurType = $utilisateurType;

        return $this;
    }

    /**
     * @return Collection|Devis[]
     */
    public function getDevis(): Collection
    {
        return $this->devis;
    }

    public function addDevi(Devis $devi): self
    {
        if (!$this->devis->contains($devi)) {
            $this->devis[] = $devi;
            $devi->setUtilisateur($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->contains($devi)) {
            $this->devis->removeElement($devi);
            // set the owning side to null (unless already changed)
            if ($devi->getUtilisateur() === $this) {
                $devi->setUtilisateur(null);
            }
        }

        return $this;
    }
}
