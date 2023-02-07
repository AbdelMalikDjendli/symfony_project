<?php

namespace App\Entity;

use App\Repository\EventRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?string $invited = null;


    #[ORM\Column(length: 100)]
    private ?string $level = null;

    #[ORM\Column(length: 255)]
    private ?string $hour = null;

    #[ORM\Column(length: 50)]
    private ?\DateTimeImmutable $date = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'parent')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $organizer = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Five $five = null;

    #[ORM\ManyToMany(targetEntity: Team::class, mappedBy: 'match')]
    #[ORM\JoinTable("team_event")]
    private Collection $teamsevent;


    /**
     * @return Collection
     */
    public function getTeamsevent(): Collection
    {
        return $this->teamsevent;
    }

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $winner = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $looser = null;

    public function __construct()
    {
        $this->teamsevent = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvited(): ?string
    {
        return $this->invited;
    }

    public function setInvited(string $invited): self
    {
        $this->invited = $invited;

        return $this;
    }





    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getHour(): ?string
    {
        return $this->hour;
    }

    public function setHour(string $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(DateTimeImmutable $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOrganizer(): ?User
    {
        return $this->organizer;
    }

    public function setOrganizer(?User $organizer): self
    {
        $this->organizer = $organizer;

        return $this;
    }

    public function getFive(): ?Five
    {
        return $this->five;
    }

    public function setFive(?Five $five): self
    {
        $this->five = $five;

        return $this;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teamsevent->contains($team)) {
            $this->teamsevent->add($team);
            $team->addParent($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teamsevent->removeElement($team)) {
            $team->removeParent($this);
        }

        return $this;
    }

    public function getWinner(): ?string
    {
        return $this->winner;
    }

    public function setWinner(?string $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getLooser(): ?string
    {
        return $this->looser;
    }

    public function setLooser(?string $looser): self
    {
        $this->looser = $looser;

        return $this;
    }




}
