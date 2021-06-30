<?php

namespace App\Entity;

use App\Repository\PlateformeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlateformeRepository::class)
 */
class Plateforme
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
     * @ORM\OneToMany(targetEntity=Jeuxvideo::class, mappedBy="plateforme")
     */
    private $jeuxvideos;

    public function __construct()
    {
        $this->jeuxvideos = new ArrayCollection();
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

    /**
     * @return Collection|Jeuxvideo[]
     */
    public function getJeuxvideos(): Collection
    {
        return $this->jeuxvideos;
    }

    public function addJeuxvideo(Jeuxvideo $jeuxvideo): self
    {
        if (!$this->jeuxvideos->contains($jeuxvideo)) {
            $this->jeuxvideos[] = $jeuxvideo;
            $jeuxvideo->setPlateforme($this);
        }

        return $this;
    }

    public function removeJeuxvideo(Jeuxvideo $jeuxvideo): self
    {
        if ($this->jeuxvideos->removeElement($jeuxvideo)) {
            // set the owning side to null (unless already changed)
            if ($jeuxvideo->getPlateforme() === $this) {
                $jeuxvideo->setPlateforme(null);
            }
        }

        return $this;
    }
}
