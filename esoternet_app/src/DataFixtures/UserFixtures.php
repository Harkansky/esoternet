<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, User::class, function (User $user, $i){
            $user->setName($this->faker->name());
            $user->setEmail($this->faker->email());
            $user->setPassword($this->faker->password());
            $user->setRegistrationDate($this->faker->dateTime());
            $this->addEntityReference('user_' . $i, $user);
        });
    }
}