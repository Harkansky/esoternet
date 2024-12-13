<?php

namespace App\DataFixtures;

use App\Entity\Target;
use Doctrine\Persistence\ObjectManager;

class TargetFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, Target::class, function (Target $target, $i){
            $target->setName($this->faker->name());
            $target->setDescription($this->faker->text());
            $target->setBirthDate($this->faker->optional()->dateTime());
            $target->setType($this->faker->randomElement(['Person', 'Group', 'Entity']));
            $target->setStatus($this->faker->randomElement(['Active', 'Protected', 'Cursed', 'Dead']));
            $this->addEntityReference("target_" . $i, $target);
        });
    }
}