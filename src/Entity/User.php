<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Un compte possède deja cet E-mail !')]
#[UniqueEntity(fields: ['pseudo'], message: 'Ce pseudo est deja utilisé !')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 100)]
    private ?string $lastName = null;

    #[ORM\Column(length: 50)]
    private ?string $firstName = null;

    #[ORM\Column]
    private ?string $numTel = null;

    #[ORM\Column(length: 100, unique:true)]
    private ?string $pseudo = null;

    #[ORM\Column(length: 150)]
    private ?string $ville = null;

    #[ORM\Column(length: 5)]
    private ?string $codePostal = null;

    #[ORM\Column(options : ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\OneToMany(mappedBy: 'organizer', targetEntity: Event::class)]
    private Collection $parent;

    #[ORM\OneToMany(mappedBy: 'creator', targetEntity: Team::class)]
    private Collection $teams_user;

    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbNote = null;

    #[ORM\ManyToMany(targetEntity: self::class, inversedBy: 'users')]
    private Collection $evaluator;

    #[ORM\ManyToMany(targetEntity: self::class, mappedBy: 'evaluator')]
    private Collection $users;

    public function __construct()
    {
        $this->parent = new ArrayCollection();
        $this->teams_user = new ArrayCollection();
        $this->created_at = new \DateTimeImmutable();
        $this->note = 0;
        $this->nbNote = 0;
        $this->evaluator = new ArrayCollection();
        $this->users = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getNumTel(): ?string
    {
        return $this->numTel;
    }

    public function setNumTel(string $numTel): self
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): self
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getParent(): Collection
    {
        return $this->parent;
    }

    public function addParent(Event $parent): self
    {
        if (!$this->parent->contains($parent)) {
            $this->parent->add($parent);
            $parent->setOrganizer($this);
        }

        return $this;
    }

    public function removeParent(Event $parent): self
    {
        if ($this->parent->removeElement($parent)) {
            // set the owning side to null (unless already changed)
            if ($parent->getOrganizer() === $this) {
                $parent->setOrganizer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams_user;
    }

    public function addTeam(Team $team): self
    {
        if (!$this->teams_user->contains($team)) {
            $this->teams_user->add($team);
            $team->setCreator($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): self
    {
        if ($this->teams_user->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getCreator() === $this) {
                $team->setCreator(null);
            }
        }

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getNbNote(): ?int
    {
        return $this->nbNote;
    }

    public function setNbNote(?int $nbNote): self
    {
        $this->nbNote = $nbNote;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getEvaluator(): Collection
    {
        return $this->evaluator;
    }

    public function addEvaluator(self $evaluator): self
    {
        if (!$this->evaluator->contains($evaluator)) {
            $this->evaluator->add($evaluator);
        }

        return $this;
    }

    public function removeEvaluator(self $evaluator): self
    {
        $this->evaluator->removeElement($evaluator);

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(self $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addEvaluator($this);
        }

        return $this;
    }

    public function removeUser(self $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeEvaluator($this);
        }

        return $this;
    }

}
