<?php

namespace App\Repository;

use App\Entity\Ritual;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ritual>
 */
class RitualRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ritual::class);
    }

    public function findRitualForShow($id)
    {
        return $this->createQueryBuilder('r')
            ->select('r.id', 'r.name', 'r.description')
            ->where('r.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
