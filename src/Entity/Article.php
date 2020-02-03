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
    private $idCategorieBlog;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UtilisateurAdministration")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUtilisateurAdmin;

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

    public function getIdCategorieBlog(): ?CategorieBlog
    {
        return $this->idCategorieBlog;
    }

    public function setIdCategorieBlog(CategorieBlog $idCategorieBlog): self
    {
        $this->idCategorieBlog = $idCategorieBlog;

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
