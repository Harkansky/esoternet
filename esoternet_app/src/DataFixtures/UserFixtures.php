<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\UserAccountStatusEnum;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends BaseFixture
{
    protected function createOneTest(): void
    {
        $entity = new User();
        $entity->setName("Test");
        $entity->setEmail("test@test.test");
        $entity->setPlainPassword("test");
        $entity->setRoles(['ROLE_USER']);
        $entity->setRegistrationDate($this->faker->dateTime());
        $entity->setAccountStatus(UserAccountStatusEnum::ACTIVE);
        $this->getObjectManager()->persist($entity);
    }

    protected function createOneAdmin(): void
    {
        $entity = new User();
        $entity->setName("Admin");
        $entity->setEmail("admin@admin.admin");
        $entity->setPlainPassword("admin");
        $entity->setRoles(['ROLE_ADMIN']);
        $entity->setRegistrationDate($this->faker->dateTime());
        $entity->setAccountStatus(UserAccountStatusEnum::ACTIVE);
        $this->getObjectManager()->persist($entity);
    }

    protected function loadData(ObjectManager $manager):void
    {
        $this->createOneTest();
        $this->createOneAdmin();
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