<?php

namespace App\DataFixtures;

use App\Entity\Material;
use Doctrine\Persistence\ObjectManager;

class MaterialFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, Material::class, function (Material $material, $i){
            $material->setName($this->faker->word());
            $this->addEntityReference("material_" . $i, $material);
        });
    }
}