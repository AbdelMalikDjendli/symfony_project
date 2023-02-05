<?php

namespace App\Entity;

use App\Repository\EventRepository;
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

    #[ORM\Column]
    private ?int $invited = null;


    #[ORM\Column(length: 100)]
    private ?string $level = null;

    #[ORM\Column(length: 255)]
    private ?string $hour = null;

    #[ORM\Column(length: 50)]
    private ?string $date = null;

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
    private Collection $teams_event;


    /**
     * @return Collection
     */
    public function getTeamsEvent(): Collection
    {
        return $this->teams_event;
    }

    public function __construct()
    {
        $this->teams_event = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInvited(): ?int
    {
        return $this->invited;
    }

    public function setInvited(int $invited): self
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

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
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
        if (!$this->teams_event->contains($team)) {
            $this->teams_event->add($team);
            $team->addParent($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams_event->removeElement($team)) {
            $team->removeParent($this);
        }

        return $this;
    }




}
