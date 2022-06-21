<?php

namespace App\Entity;

use App\Repository\SessionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionsRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $NomDeSession;

    #[ORM\Column(type: 'string', length: 255)]
    private $EtatDeSession;

    #[ORM\Column(type: 'integer')]
    private $NombreParticipants;

    #[ORM\OneToMany(mappedBy: 'Session', targetEntity: User::class, orphanRemoval: true, cascade: ["persist"])]
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomDeSession(): ?string
    {
        return $this->NomDeSession;
    }

    public function setNomDeSession(string $NomDeSession): self
    {
        $this->NomDeSession = $NomDeSession;

        return $this;
    }

    public function getEtatDeSession(): ?string
    {
        return $this->EtatDeSession;
    }

    public function setEtatDeSession(string $EtatDeSession): self
    {
        $this->EtatDeSession = $EtatDeSession;

        return $this;
    }

    public function getNombreParticipants(): ?int
    {
        return $this->NombreParticipants;
    }

    public function setNombreParticipants(int $NombreParticipants): self
    {
        $this->NombreParticipants = $NombreParticipants;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function __toString() {
        return $this->id;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setSession($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getSession() === $this) {
                $user->setSession(null);
            }
        }

        return $this;
    }
}
