<?php

namespace App\Entity;

use App\Repository\JeuxvideoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JeuxvideoRepository::class)
 */
class Jeuxvideo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="jeuxvideos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity=Plateforme::class, inversedBy="jeuxvideos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plateforme;

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

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPlateforme(): ?Plateforme
    {
        return $this->plateforme;
    }

    public function setPlateforme(?Plateforme $plateforme): self
    {
        $this->plateforme = $plateforme;

        return $this;
    }
}
