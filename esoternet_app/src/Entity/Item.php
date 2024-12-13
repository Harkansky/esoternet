<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateAdded = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\ManyToMany(targetEntity: Order::class, inversedBy: 'items')]
    private Collection $listPurchase;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?Region $origin = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?Religion $religionLink = null;

    /**
     * @var Collection<int, Ritual>
     */
    #[ORM\ManyToMany(targetEntity: Ritual::class, inversedBy: 'items')]
    private Collection $ritualLink;

    /**
     * @var Collection<int, Pact>
     */
    #[ORM\ManyToMany(targetEntity: Pact::class, inversedBy: 'items')]
    private Collection $pactLink;

    /**
     * @var Collection<int, Material>
     */
    #[ORM\ManyToMany(targetEntity: Material::class, inversedBy: 'ingredients')]
    private Collection $materialLink;

    #[ORM\ManyToOne(inversedBy: 'items')]
    private ?Currency $payment = null;

    public function __construct()
    {
        $this->listPurchase = new ArrayCollection();
        $this->ritualLink = new ArrayCollection();
        $this->pactLink = new ArrayCollection();
        $this->materialLink = new ArrayCollection();
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getDateAdded(): ?\DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(\DateTimeInterface $dateAdded): static
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getListPurchase(): Collection
    {
        return $this->listPurchase;
    }

    public function addListPurchase(Order $listPurchase): static
    {
        if (!$this->listPurchase->contains($listPurchase)) {
            $this->listPurchase->add($listPurchase);
        }

        return $this;
    }

    public function removeListPurchase(Order $listPurchase): static
    {
        $this->listPurchase->removeElement($listPurchase);

        return $this;
    }

    public function getOrigin(): ?Region
    {
        return $this->origin;
    }

    public function setOrigin(?Region $origin): static
    {
        $this->origin = $origin;

        return $this;
    }

    public function getReligionLink(): ?Religion
    {
        return $this->religionLink;
    }

    public function setReligionLink(?Religion $religionLink): static
    {
        $this->religionLink = $religionLink;

        return $this;
    }

    /**
     * @return Collection<int, Ritual>
     */
    public function getRitualLink(): Collection
    {
        return $this->ritualLink;
    }

    public function addRitualLink(Ritual $ritualLink): static
    {
        if (!$this->ritualLink->contains($ritualLink)) {
            $this->ritualLink->add($ritualLink);
        }

        return $this;
    }

    public function removeRitualLink(Ritual $ritualLink): static
    {
        $this->ritualLink->removeElement($ritualLink);

        return $this;
    }

    /**
     * @return Collection<int, Pact>
     */
    public function getPactLink(): Collection
    {
        return $this->pactLink;
    }

    public function addPactLink(Pact $pactLink): static
    {
        if (!$this->pactLink->contains($pactLink)) {
            $this->pactLink->add($pactLink);
        }

        return $this;
    }

    public function removePactLink(Pact $pactLink): static
    {
        $this->pactLink->removeElement($pactLink);

        return $this;
    }

    /**
     * @return Collection<int, Material>
     */
    public function getMaterialLink(): Collection
    {
        return $this->materialLink;
    }

    public function addMaterialLink(Material $materialLink): static
    {
        if (!$this->materialLink->contains($materialLink)) {
            $this->materialLink->add($materialLink);
        }

        return $this;
    }

    public function removeMaterialLink(Material $materialLink): static
    {
        $this->materialLink->removeElement($materialLink);

        return $this;
    }

    public function getPayment(): ?Currency
    {
        return $this->payment;
    }

    public function setPayment(?Currency $payment): static
    {
        $this->payment = $payment;

        return $this;
    }
}
