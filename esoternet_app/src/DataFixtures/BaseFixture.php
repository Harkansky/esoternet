<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

abstract class BaseFixture extends Fixture
{
    protected $faker;
    private ObjectManager $manager;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    protected function createMany(int $count, string $entityClass, callable $factory): void
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = new $entityClass;
            $factory($entity, $i);
            $this->getObjectManager()->persist($entity);
        }
    }

    protected function getObjectManager(): ObjectManager
    {
        return $this->manager;
    }

    public function load(ObjectManager $manager): void
    {
        $this->manager = $manager;
        $this->loadData($manager);
        $manager->flush();
    }

    abstract protected function loadData(ObjectManager $manager): void;

    protected function addEntityReference(string $name, object $entity): void
    {
        $this->addReference($name, $entity);
    }

    protected function getEntityReference(string $name, string $class): object
    {
        return $this->getReference($name, $class);
    }
}
