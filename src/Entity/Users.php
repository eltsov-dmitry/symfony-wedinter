<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsersRepository::class)
 */
class Users
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $appeal;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isVisit;

    /**
     * @ORM\ManyToOne(targetEntity=Sites::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $site;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setUuid($uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    public function getAppeal(): ?string
    {
        return $this->appeal;
    }

    public function setAppeal(?string $appeal): self
    {
        $this->appeal = $appeal;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

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

    public function getIsVisit(): ?bool
    {
        return $this->isVisit;
    }

    public function setIsVisit(?bool $isVisit): self
    {
        $this->isVisit = $isVisit;

        return $this;
    }

    public function getSite(): ?Sites
    {
        return $this->site;
    }

    public function setSite(?Sites $site): self
    {
        $this->site = $site;

        return $this;
    }

    public function toArray(): array
    {
        return [
            "uid" => $this->uuid,
            "appeal" => $this->appeal,
            "name" => $this->name,
            "description" => $this->description,
            "is_visit" => $this->isVisit,
        ];
    }
}
