<?php

namespace App\Entity;

use App\Repository\MinorEntityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MinorEntityRepository::class)]
class MinorEntity extends Entity
{

    #[ORM\Column(length: 255)]
    private ?string $minorTrait = null;

    #[ORM\ManyToOne(inversedBy: 'supervises')]
    private ?SuperiorEntity $superiorEntity = null;

    public function getMinorTrait(): ?string
    {
        return $this->minorTrait;
    }

    public function setMinorTrait(string $minorTrait): static
    {
        $this->minorTrait = $minorTrait;

        return $this;
    }

    public function getSuperiorEntity(): ?SuperiorEntity
    {
        return $this->superiorEntity;
    }

    public function setSuperiorEntity(?SuperiorEntity $superiorEntity): static
    {
        $this->superiorEntity = $superiorEntity;

        return $this;
    }
}
