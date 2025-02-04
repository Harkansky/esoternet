<?php

namespace App\Entity;

use App\Repository\RitualRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: RitualRepository::class)]
class Ritual
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['ritual:read', 'pdf:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['ritual:read', 'pdf:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['ritual:read', 'pdf:read'])]
    private ?string $description = null;

    /**
     * @var Collection<int, Item>
     */
    #[ORM\ManyToMany(targetEntity: Item::class, mappedBy: 'ritualLink')]
    private Collection $items;

    /**
     * @var Collection<int, Target>
     */
    #[ORM\ManyToMany(targetEntity: Target::class, inversedBy: 'rituals')]
    private Collection $target;

    #[ORM\ManyToOne(inversedBy: 'rituals')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entity $entity = null;

    public function __construct()
    {
        $this->items = new ArrayCollection();
        $this->target = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->addRitualLink($this);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->items->removeElement($item)) {
            $item->removeRitualLink($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, target>
     */
    public function getTarget(): Collection
    {
        return $this->target;
    }

    public function addTarget(target $target): static
    {
        if (!$this->target->contains($target)) {
            $this->target->add($target);
        }

        return $this;
    }

    public function removeTarget(target $target): static
    {
        $this->target->removeElement($target);

        return $this;
    }

    public function getEntity(): ?Entity
    {
        return $this->entity;
    }

    public function setEntity(?Entity $entity): static
    {
        $this->entity = $entity;

        return $this;
    }
}
