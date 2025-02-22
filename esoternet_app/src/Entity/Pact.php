<?php
// src/Entity/Pact.php

namespace App\Entity;

use App\Repository\PactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: PactRepository::class)]
class Pact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['pact:read', 'pdf:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['pact:read', 'pdf:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['pact:read', 'pdf:read'])]
    private ?string $effect = null;

    #[ORM\Column]
    private ?int $duration = null;

    /**
     * @var Collection<int, Item>
     */
    #[ORM\ManyToMany(targetEntity: Item::class, mappedBy: 'pactLink')]
    private Collection $items;

    // Utiliser ?Entity au lieu de ?entity
    #[ORM\ManyToOne(inversedBy: 'pacts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entity $entity = null; // Modifié ici

    public function __construct()
    {
        $this->items = new ArrayCollection();
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

    public function getEffect(): ?string
    {
        return $this->effect;
    }

    public function setEffect(string $effect): static
    {
        $this->effect = $effect;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(int $duration): static
    {
        $this->duration = $duration;

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
            $item->addPactLink($this);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->items->removeElement($item)) {
            $item->removePactLink($this);
        }

        return $this;
    }

    public function getEntity(): ?Entity // Modifié ici
    {
        return $this->entity;
    }

    public function setEntity(?Entity $entity): static // Modifié ici
    {
        $this->entity = $entity;

        return $this;
    }
}
