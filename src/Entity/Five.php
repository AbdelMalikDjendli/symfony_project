<?php

namespace App\Entity;

use App\Repository\FiveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FiveRepository::class)]
class Five
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(length: 255)]
    private ?string $timetable = null;

    #[ORM\OneToMany(mappedBy: 'five', targetEntity: Event::class, orphanRemoval: true)]
    private Collection $parents;

    public function __construct()
    {
        $this->parents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getTimetable(): ?string
    {
        return $this->timetable;
    }

    public function setTimetable(string $timetable): self
    {
        $this->timetable = $timetable;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getParents(): Collection
    {
        return $this->parents;
    }

    public function addEvent(Event $event): self
    {
        if (!$this->parents->contains($event)) {
            $this->parents->add($event);
            $event->setFive($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): self
    {
        if ($this->parents->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getFive() === $this) {
                $event->setFive(null);
            }
        }

        return $this;
    }
}
