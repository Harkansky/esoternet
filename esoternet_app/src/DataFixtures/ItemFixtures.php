<?php

namespace App\DataFixtures;

use App\Entity\Item;
use App\Entity\Currency;
use App\Entity\Material;
use App\Entity\Pact;
use App\Entity\Region;
use App\Entity\Religion;
use App\Entity\Ritual;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ItemFixtures extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, Item::class, function (Item $item, $i){
            $item->setName($this->faker->words(null, true));
            $item->setDateAdded($this->faker->dateTime());
            $item->setDescription($this->faker->text());
            $item->setOrigin($this->getEntityReference("region_" . rand(0,49), Region::class));
            $item->setReligionLink($this->getEntityReference("religion_" . rand(0,49), Religion::class));
            $item->setPayment($this->getEntityReference("currency_" . rand(0,49), Currency::class));
            $item->setPrice($this->faker->randomFloat(2));
            $item->addMaterialLink($this->getEntityReference("material_" . rand(0,49), Material::class));
            $item->addPactLink($this->getEntityReference("pact_" . rand(0,49), Pact::class));
            $item->addRitualLink($this->getEntityReference("ritual_" . rand(0,49), Ritual::class));
            $this->addEntityReference("item_" . $i, $item);
        });
    }

    public function getDependencies(): array
    {
        return [CurrencyFixtures::class, MaterialFixtures::class, PactFixtures::class, RegionFixtures::class, ReligionFixtures::class, RitualFixtures::class];
    }
}