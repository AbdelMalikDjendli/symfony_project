<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $player1 = null;

    #[ORM\Column(length: 150)]
    private ?string $player2 = null;

    #[ORM\Column(length: 150)]
    private ?string $player3 = null;

    #[ORM\Column(length: 150)]
    private ?string $player4 = null;

    #[ORM\Column(length: 150)]
    private ?string $player5 = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'teams_event')]
    private Collection $match;

    #[ORM\ManyToOne(inversedBy: 'teams_user')]
    private ?User $creator = null;

    public function __construct()
    {
        $this->match = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlayer1(): ?string
    {
        return $this->player1;
    }

    public function setPlayer1(string $player1): self
    {
        $this->player1 = $player1;

        return $this;
    }

    public function getPlayer2(): ?string
    {
        return $this->player2;
    }

    public function setPlayer2(string $player2): self
    {
        $this->player2 = $player2;

        return $this;
    }

    public function getPlayer3(): ?string
    {
        return $this->player3;
    }

    public function setPlayer3(string $player3): self
    {
        $this->player3 = $player3;

        return $this;
    }

    public function getPlayer4(): ?string
    {
        return $this->player4;
    }

    public function setPlayer4(string $player4): self
    {
        $this->player4 = $player4;

        return $this;
    }

    public function getPlayer5(): ?string
    {
        return $this->player5;
    }

    public function setPlayer5(string $player5): self
    {
        $this->player5 = $player5;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getMatch(): Collection
    {
        return $this->match;
    }

    public function addParent(Event $parent): self
    {
        if (!$this->match->contains($parent)) {
            $this->match->add($parent);
        }

        return $this;
    }

    public function removeParent(Event $parent): self
    {
        $this->match->removeElement($parent);

        return $this;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): self
    {
        $this->creator = $creator;

        return $this;
    }
}
