<?php

namespace App\DataFixtures;

use App\Entity\Region;
use Doctrine\Persistence\ObjectManager;

class RegionFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, Region::class, function (Region $region, $i){
            $region->setName($this->faker->country());
            $this->addEntityReference("region_" . $i, $region);
        });
    }
}