<?php

namespace App\DataFixtures;

use App\Entity\Religion;
use Doctrine\Persistence\ObjectManager;

class ReligionFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, Religion::class, function (Religion $religion, $i){
            $religion->setName($this->faker->word());
            $this->addEntityReference("religion_" . $i, $religion);
        });
    }
}