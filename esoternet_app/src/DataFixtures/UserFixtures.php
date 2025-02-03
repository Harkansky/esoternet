<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, User::class, function (User $user, $i){
            $user->setName($this->faker->name());
            $user->setEmail($this->faker->email());
            $user->setPlainPassword(plainPassword: 'toto');
            $i<5 ? $user->setRoles(['ROLE_ADMIN']) : $user->setRoles(['ROLE_USER']);
            $user->setRegistrationDate($this->faker->dateTime());
            $user->setAccountStatus(UserAccountStatusEnum::ACTIVE);
            $this->addEntityReference('user_' . $i, $user);
        });
    }
}