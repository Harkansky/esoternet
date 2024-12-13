<?php

namespace App\DataFixtures;

use App\Entity\Currency;
use Doctrine\Persistence\ObjectManager;

class CurrencyFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, Currency::class, function (Currency $currency, $i){
            $currency->setName($this->faker->word());
            $currency->setDescription($this->faker->text());
            $this->addEntityReference('currency_' . $i, $currency);
        });
    }
}