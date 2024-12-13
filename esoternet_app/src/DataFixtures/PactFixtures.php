<?php

namespace App\DataFixtures;

use App\Entity\Pact;
use App\Entity\Entity;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PactFixtures extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, Pact::class, function (Pact $pact, $i){
            $pact->setName($this->faker->word());
            $pact->setEffect($this->faker->text());
            $pact->setDuration($this->faker->randomNumber());
            $this->addEntityReference('pact_' . $i, $pact);
            $pact->setEntity($this->getEntityReference('entity_' . rand(0,49), Entity::class));
        });
    }

    public function getDependencies(): array
    {
        return [EntityFixtures::class];
    }
}