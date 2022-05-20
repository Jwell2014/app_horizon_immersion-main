<?php

namespace App\Entity;

use App\Repository\ChronoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChronoRepository::class)]
class Chrono
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer', columnDefinition: "INT(2) ZEROFILL")]
    private $heure;

    #[ORM\Column(type: 'integer', columnDefinition: "INT(2) ZEROFILL")]
    private $minute;

    #[ORM\Column(type: 'integer', columnDefinition: "INT(2) ZEROFILL")]
    private $seconde;

    #[ORM\Column(type: 'integer')]
    private $zero;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeure(): ?int
    {
        return $this->heure;
    }

    public function setHeure(int $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getMinute(): ?int
    {
        return $this->minute;
    }

    public function setMinute(int $minute): self
    {
        $this->minute = $minute;

        return $this;
    }

    public function getSeconde(): ?int
    {
        return $this->seconde;
    }

    public function setSeconde(int $seconde): self
    {
        $this->seconde = $seconde;

        return $this;
    }

    public function getZero(): ?int
    {
        return $this->zero;
    }

    public function setZero(int $zero): self
    {
        $this->zero = $zero;

        return $this;
    }
}
