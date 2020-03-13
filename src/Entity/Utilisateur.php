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
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $civilite;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *   pattern = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/m",
     *   match=true,
     *   message="Votre mot de passe doit comporter au moins huit caractères, dont des lettres majuscules et minuscules, un chiffre et un caractère spécial."
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
     * @Assert\Length(
     *   min = 14,
     *   minMessage="Veuillez saisir un N° de SIRET valide",
     * )
     * * @Assert\Length(
     *   max = 14,
     *   maxMessage="Veuillez saisir un N° de SIRET valide",
     * )
     * @ORM\Column(type="string", nullable=true)
     */
    private $siret;

    /**
     * @Assert\Length(
     *   min = 10,
     *   minMessage="Veuillez saisir un numéro de téléphone valide",
     * )
     * @Assert\Length(
     *   max = 10,
     *   maxMessage="Veuillez saisir un numéro de téléphone valide",
     * )
     * @ORM\Column(type="string")
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $fonctionRepresentant;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Adresse", mappedBy="Utilisateur")
     */
    private $Adresse;

    private $conditions;

    /**
     * Assert\EqualTo(propertyPath="password")
     */
    private $passwordConfirm;
    /**
     * Assert\EqualTo(propertyPath=email)
     */
    private $emailConfirm;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Commande", mappedBy="User")
     */
    private $commandes;

    public function __construct()
    {
        $this->Adresse = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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

    public function getSiret(): ?string
    {
        return $this->siret;
    }

    public function setSiret(?string $siret): self
    {
        $this->siret = $siret;

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
        return (string)$this->email;
    }

    public function getNomPrenom(): string
    {
        return (string)$this->nom.' '.$this->prenom;
    }

    public function erasecredentials()
    {
    }

    public function getSalt()
    {

    }

    public function getRoles()
    {
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

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setUser($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->contains($commande)) {
            $this->commandes->removeElement($commande);
            // set the owning side to null (unless already changed)
            if ($commande->getUser() === $this) {
                $commande->setUser(null);
            }
        }
    }
}
