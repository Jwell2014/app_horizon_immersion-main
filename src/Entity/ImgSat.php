<?php

namespace App\Entity;

use App\Repository\ImgSatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImgSatRepository::class)]
class   ImgSat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\Column(type: 'boolean')]
    private $isActive;

    #[ORM\ManyToOne(targetEntity: Dossier::class, inversedBy: 'imgSats')]
    private $DossierParent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getDossierParent(): ?Dossier
    {
        return $this->DossierParent;
    }

    public function setDossierParent(?Dossier $DossierParent): self
    {
        $this->DossierParent = $DossierParent;

        return $this;
    }
}
