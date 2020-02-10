<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @UniqueEntity(
 *  fields={"email"},
 *  message="L'email que vous avez indiqué est déja utilisé !"
 * )
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\Email(
     *     message = "L'email '{{ value }}' n'est pas valide."
     *   )
     * @Assert\EqualTo(propertyPath="email")
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $civilite;

    /**
    * @ORM\Column(type="string", length=255)
    * @Assert\Regex(
    *   pattern = "/^(?=.*\d)(?=.*[A-Z])(?=.*[@#$%])(?!.*(.)\1{2}).*[a-z]/m",
    *   match=true,
    *   message="Votre mot de passe doit comporter au moins huit caractères, dont des lettres majuscules et minuscules, un chiffre et un symbole."
    * )
     * Assert\EqualTo(propertyPath="passwordConfirm")
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $siret;

    /**
     * @ORM\Column(type="integer")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $fonctionRepresentant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="Utilisateur", orphanRemoval=true)
     */
    private $Adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Devis", mappedBy="Utilisateur", orphanRemoval=true)
     */
    private $devis;

    private $conditions;

    /**
      * Assert\EqualTo(propertyPath="password") 
    */
    private $passwordConfirm;
    /**
      * Assert\EqualTo(propertyPath=email) 
    */
    private $emailConfirm;

    public function __construct()
    {
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

    public function getCivilite(): ?string
    {
        return $this->civilite;
    }

    public function setCivilite(?string $civilite): self
    {
        $this->civilite = $civilite;

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
        return $this->tokenPassword;
    }

    public function setTokenPassword(?string $tokenPassword): self
    {
        $this->tokenPassword = $tokenPassword;

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

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(?int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

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

    public function getConditions(): ?string
    {
        return $this->conditions;
    }

    public function setConditions(string $conditions): self
    {
        $this->conditions = $conditions;

        return $this;
    }

    public function getPasswordConfirm(): ?string
    {
        return $this->passwordConfirm;
    }

    public function setPasswordConfirm(string $passwordConfirm): self
    {
        $this->passwordConfirm = $passwordConfirm;

        return $this;
    }
    
    public function getEmailConfirm(): ?string
    {
        return $this->emailConfirm;
    }

    public function setEmailConfirm(string $emailConfirm): self
    {
        $this->emailConfirm = $emailConfirm;

        return $this;
    }

    public function getUsername(): string
    {
        return (string) $this->email;
    }
    public function erasecredentials()
    {
    }
    public function getSalt()
    {
        
    }

    public function getRoles(){
        return ['ROLE_USER'];
    }

    public function getFonctionRepresentant(): ?string
    {
        return $this->fonctionRepresentant;
    }

    public function setFonctionRepresentant(?string $fonctionRepresentant): self
    {
        $this->fonctionRepresentant = $fonctionRepresentant;

        return $this;
    }
   
}
