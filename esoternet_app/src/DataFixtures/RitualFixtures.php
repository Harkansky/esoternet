<?php

namespace App\DataFixtures;

use App\Entity\Ritual;
use App\Entity\Entity;
use App\Entity\Target;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class RitualFixtures extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, Ritual::class, function (Ritual $ritual, $i){
            $ritual->setName($this->faker->word());
            $ritual->setDescription($this->faker->text());
            $this->addEntityReference('ritual_' . $i, $ritual);
            $ritual->setEntity($this->getEntityReference('entity_' . rand(0,49), Entity::class));
            for ($i=0; $i < rand(0,5); $i++) { 
                $ritual->addTarget($this->getEntityReference("target_" . $this->faker->numberBetween(0,49),Target::class));
            }
        });
    }

    public function getDependencies(): array
    {
        return [EntityFixtures::class, TargetFixtures::class];
    }
}