<?php

namespace App\Entity;

use App\Repository\SitesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SitesRepository::class)
 */
class Sites
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="uuid")
     */
    private $uuid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_male;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name_female;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $text = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $events = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $map_props = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $contacts = [];

    /**
     * @ORM\OneToMany(targetEntity=Users::class, mappedBy="site", orphanRemoval=true)
     */
    private $users;


    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUid($uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getNameMale(): ?string
    {
        return $this->name_male;
    }

    public function setNameMale(string $name_male): self
    {
        $this->name_male = $name_male;

        return $this;
    }

    public function getNameFemale(): ?string
    {
        return $this->name_female;
    }

    public function setNameFemale(string $name_female): self
    {
        $this->name_female = $name_female;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getText(): ?array
    {
        return $this->text;
    }

    public function setText(?array $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "name_male" => $this->name_male,
            "name_female" => $this->name_female,
            "date" => $this->date,
            "text" => $this->text,
            "events" => $this->events,
            "map_props" => $this->map_props,
            "contacts" => $this->contacts,
        ];
    }

    public function getEvents(): ?array
    {
        return $this->events;
    }

    public function setEvents(?array $events): self
    {
        $this->events = $events;

        return $this;
    }

    public function getMapProps(): ?array
    {
        return $this->map_props;
    }

    public function setMapProps(?array $map_props): self
    {
        $this->map_props = $map_props;

        return $this;
    }

    public function getContacts(): ?array
    {
        return $this->contacts;
    }

    public function setContacts(?array $contacts): self
    {
        $this->contacts = $contacts;

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Users $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setSite($this);
        }

        return $this;
    }

    public function removeUser(Users $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getSite() === $this) {
                $user->setSite(null);
            }
        }

        return $this;
    }

}
