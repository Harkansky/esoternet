<?php

namespace App\Repository;

use App\Entity\Pact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pact>
 */
class PactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pact::class);
    }

    public function findPactForShow($id)
    {
        return $this->createQueryBuilder('p')
            ->select('p.id', 'p.name', 'p.effect', 'p.duration')
            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
