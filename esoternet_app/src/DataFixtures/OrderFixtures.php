<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\Item;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(100, Order::class, function (Order $order, $i){
            $order->setPurchaser($this->getEntityReference('user_' . rand(0,49), User::class));
            $order->setOrderDate($this->faker->dateTime());
            $order->setTotalAmount($this->faker->randomFloat(2));
            for ($i=0; $i < rand(1,9); $i++) { 
                $order->addItem($this->getEntityReference("item_" . $this->faker->numberBetween(0,49), Item::class));
            }
        });
    }

    public function getDependencies(): array
    {
        return [ItemFixtures::class, UserFixtures::class];
    }
}