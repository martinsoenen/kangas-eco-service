<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
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
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\CategorieBlog")
     * @ORM\JoinColumn(nullable=false)
     */
    private $CategorieBlog;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilisateurAdministration")
     * @ORM\JoinColumn(nullable=false)
     */
    private $UtilisateurAdmin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function getCategorieBlog(): ?CategorieBlog
    {
        return $this->CategorieBlog;
    }

    public function setCategorieBlog(CategorieBlog $CategorieBlog): self
    {
        $this->CategorieBlog = $CategorieBlog;

        return $this;
    }

    public function getUtilisateurAdmin(): ?UtilisateurAdministration
    {
        return $this->UtilisateurAdmin;
    }

    public function setUtilisateurAdmin(?UtilisateurAdministration $UtilisateurAdmin): self
    {
        $this->UtilisateurAdmin = $UtilisateurAdmin;

        return $this;
    }

   
}
