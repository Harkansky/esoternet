<?php

namespace App\Entity;

use App\Repository\SuperiorEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SuperiorEntityRepository::class)]
class SuperiorEntity extends Entity
{
    #[ORM\Column(length: 255)]
    private ?string $supremePower = null;

    /**
     * @var Collection<int, MinorEntity>
     */
    #[ORM\OneToMany(targetEntity: MinorEntity::class, mappedBy: 'superiorEntity')]
    private Collection $supervises;

    public function __construct()
    {
        $this->supervises = new ArrayCollection();
    }

    public function getSupremePower(): ?string
    {
        return $this->supremePower;
    }

    public function setSupremePower(string $supremePower): static
    {
        $this->supremePower = $supremePower;

        return $this;
    }

    /**
     * @return Collection<int, MinorEntity>
     */
    public function getSupervises(): Collection
    {
        return $this->supervises;
    }

    public function addSupervise(MinorEntity $supervise): static
    {
        if (!$this->supervises->contains($supervise)) {
            $this->supervises->add($supervise);
            $supervise->setSuperiorEntity($this);
        }

        return $this;
    }

    public function removeSupervise(MinorEntity $supervise): static
    {
        if ($this->supervises->removeElement($supervise)) {
            // set the owning side to null (unless already changed)
            if ($supervise->getSuperiorEntity() === $this) {
                $supervise->setSuperiorEntity(null);
            }
        }

        return $this;
    }
}
