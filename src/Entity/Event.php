<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $invited = null;

    #[ORM\Column(length: 255)]
    private ?string $team1 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $team2 = null;

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

    public function getTeam1(): ?string
    {
        return $this->team1;
    }

    public function setTeam1(string $team1): self
    {
        $this->team1 = $team1;

        return $this;
    }

    public function getTeam2(): ?string
    {
        return $this->team2;
    }

    public function setTeam2(string $team2): self
    {
        $this->team2 = $team2;

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




}
