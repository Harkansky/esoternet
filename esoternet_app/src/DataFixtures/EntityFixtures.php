<?php

namespace App\DataFixtures;

use App\Entity\Entity;
use App\Entity\MinorEntity;
use App\Entity\SuperiorEntity;
use App\Entity\Region;
use App\Entity\Religion;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EntityFixtures extends BaseFixture implements DependentFixtureInterface
{
    protected function loadData(ObjectManager $manager):void
    {
        $this->createMany(50, Entity::class, function (Entity $entity, $i){
            $entity->setName($this->faker->lastName());
            $this->addEntityReference('entity_' . $i, $entity);
            $entity->setAlignment($this->faker->randomElement(['Lawful', 'Chaotic', 'True']) . $this->faker->randomElement(['Good', 'Evil', 'Neutral']));
            $entity->setDescription($this->faker->text());
            $entity->setDomainOfInfluence($this->faker->word());
            $entity->setSpecialPower($this->faker->sentence());
            $entity->setWeakness($this->faker->word());
            $entity->setOrigin($this->faker->country());
            $entity->setLocation($this->getEntityReference('region_' . rand(0,49), Region::class));
            $entity->setEntityReligion($this->getEntityReference('religion_' . rand(0,49), Religion::class));
        });

        $this->createMany(10, SuperiorEntity::class, function(SuperiorEntity $sEntity, $i){
            $sEntity->setName($this->faker->lastName() . $this->faker->lastName());
            $this->addEntityReference('superior_entity_' . $i, $sEntity);
            $sEntity->setAlignment($this->faker->randomElement(['Lawful', 'Chaotic', 'True']) . $this->faker->randomElement(['Good', 'Evil', 'Neutral']));
            $sEntity->setDescription($this->faker->text());
            $sEntity->setDomainOfInfluence($this->faker->word());
            $sEntity->setSpecialPower($this->faker->sentence());
            $sEntity->setWeakness($this->faker->word());
            $sEntity->setOrigin($this->faker->country());
            $sEntity->setLocation($this->getEntityReference('region_' . rand(0,49), Region::class));
            $sEntity->setEntityReligion($this->getEntityReference('religion_' . rand(0,49), Religion::class));
            $sEntity->setSupremePower($this->faker->sentence());
        });

        $this->createMany(25, MinorEntity::class, function(MinorEntity $mEntity, $i){
            $mEntity->setName($this->faker->firstName());
            $this->addEntityReference('minor_entity_' . $i, $mEntity);
            $mEntity->setAlignment($this->faker->randomElement(['Lawful', 'Chaotic', 'True']) . $this->faker->randomElement(['Good', 'Evil', 'Neutral']));
            $mEntity->setDescription($this->faker->text());
            $mEntity->setDomainOfInfluence($this->faker->word());
            $mEntity->setSpecialPower($this->faker->sentence());
            $mEntity->setWeakness($this->faker->word());
            $mEntity->setOrigin($this->faker->country());
            $mEntity->setLocation($this->getEntityReference('region_' . rand(0,49), Region::class));
            $mEntity->setEntityReligion($this->getEntityReference('religion_' . rand(0,49), Religion::class));
            $mEntity->setMinorTrait($this->faker->sentence());
            $mEntity->setSuperiorEntity($this->getEntityReference('superior_entity_' . rand(0,9), SuperiorEntity::class));
        });
    }

    public function getDependencies(): array
    {
        return [RegionFixtures::class, ReligionFixtures::class];
    }
}