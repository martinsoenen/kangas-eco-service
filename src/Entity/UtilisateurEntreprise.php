<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurEntrepriseRepository")
 */
class UtilisateurEntreprise
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
    private $password;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $prenomRepresentant;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nomRepresentant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $token_password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="idUtilisateur", orphanRemoval=true)
     */
    private $devis;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Adresse", inversedBy="utilisateurEntreprises")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Adresse;

    public function __construct()
    {
        $this->devis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPrenomRepresentant(): ?string
    {
        return $this->prenomRepresentant;
    }

    public function setPrenomRepresentant(string $prenomRepresentant): self
    {
        $this->prenomRepresentant = $prenomRepresentant;

        return $this;
    }

    public function getNomRepresentant(): ?string
    {
        return $this->nomRepresentant;
    }

    public function setNomRepresentant(string $nomRepresentant): self
    {
        $this->nomRepresentant = $nomRepresentant;

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
            $devi->setIdUtilisateur($this);
        }

        return $this;
    }

    public function removeDevi(Devis $devi): self
    {
        if ($this->devis->contains($devi)) {
            $this->devis->removeElement($devi);
            // set the owning side to null (unless already changed)
            if ($devi->getIdUtilisateur() === $this) {
                $devi->setIdUtilisateur(null);
            }
        }

        return $this;
    }

    public function getIdAdresse(): ?Adresse
    {
        return $this->idAdresse;
    }

    public function setIdAdresse(?Adresse $idAdresse): self
    {
        $this->idAdresse = $idAdresse;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->Adresse;
    }

    public function setAdresse(?Adresse $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }
}
