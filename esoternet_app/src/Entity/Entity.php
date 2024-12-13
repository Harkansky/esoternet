<?php

namespace App\Entity;

use App\Repository\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntityRepository::class)]
#[ORM\InheritanceType("JOINED")]
class Entity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $origin = null;

    #[ORM\Column(length: 255)]
    private ?string $alignment = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $specialPower = null;

    #[ORM\Column(length: 255)]
    private ?string $domainOfInfluence = null;

    #[ORM\Column(length: 255)]
    private ?string $weakness = null;

    #[ORM\ManyToOne(inversedBy: 'entities')]
    private ?Religion $entityReligion = null;

    #[ORM\ManyToOne(inversedBy: 'entities')]
    private ?Region $location = null;

    /**
     * @var Collection<int, Pact>
     */
    #[ORM\OneToMany(targetEntity: Pact::class, mappedBy: 'entity', orphanRemoval: true)]
    private Collection $pacts;

    /**
     * @var Collection<int, Ritual>
     */
    #[ORM\OneToMany(targetEntity: Ritual::class, mappedBy: 'entity', orphanRemoval: true)]
    private Collection $rituals;

    public function __construct()
    {
        $this->pacts = new ArrayCollection();
        $this->rituals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getAlignment(): ?string
    {
        return $this->alignment;
    }

    public function setAlignment(string $alignment): static
    {
        $this->alignment = $alignment;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSpecialPower(): ?string
    {
        return $this->specialPower;
    }

    public function setSpecialPower(string $specialPower): static
    {
        $this->specialPower = $specialPower;

        return $this;
    }

    public function getDomainOfInfluence(): ?string
    {
        return $this->domainOfInfluence;
    }

    public function setDomainOfInfluence(string $domainOfInfluence): static
    {
        $this->domainOfInfluence = $domainOfInfluence;

        return $this;
    }

    public function getWeakness(): ?string
    {
        return $this->weakness;
    }

    public function setWeakness(string $weakness): static
    {
        $this->weakness = $weakness;

        return $this;
    }

    public function getEntityReligion(): ?Religion
    {
        return $this->entityReligion;
    }

    public function setEntityReligion(?Religion $entityReligion): static
    {
        $this->entityReligion = $entityReligion;

        return $this;
    }

    public function getLocation(): ?Region
    {
        return $this->location;
    }

    public function setLocation(?Region $location): static
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection<int, Pact>
     */
    public function getPacts(): Collection
    {
        return $this->pacts;
    }

    public function addPact(Pact $pact): static
    {
        if (!$this->pacts->contains($pact)) {
            $this->pacts->add($pact);
            $pact->setEntity($this);
        }

        return $this;
    }

    public function removePact(Pact $pact): static
    {
        if ($this->pacts->removeElement($pact)) {
            // set the owning side to null (unless already changed)
            if ($pact->getEntity() === $this) {
                $pact->setEntity(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ritual>
     */
    public function getRituals(): Collection
    {
        return $this->rituals;
    }

    public function addRitual(Ritual $ritual): static
    {
        if (!$this->rituals->contains($ritual)) {
            $this->rituals->add($ritual);
            $ritual->setEntity($this);
        }

        return $this;
    }

    public function removeRitual(Ritual $ritual): static
    {
        if ($this->rituals->removeElement($ritual)) {
            // set the owning side to null (unless already changed)
            if ($ritual->getEntity() === $this) {
                $ritual->setEntity(null);
            }
        }

        return $this;
    }
}
