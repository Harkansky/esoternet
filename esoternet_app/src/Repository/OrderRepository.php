<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findByDateRange(\DateTime $start, \DateTime $end): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.order_date >= :start')
            ->andWhere('o.order_date <= :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->orderBy('o.order_date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByDate(\DateTime $date): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.order_date = :date')
            ->setParameter('date', $date)
            ->orderBy('o.order_date', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByPriceRange(int $min, int $max): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.total_amount >= :min')
            ->andWhere('o.total_amount <= :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->orderBy('o.total_amount', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByPrice(int $price): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.total_amount = :price')
            ->setParameter('price', $price)
            ->orderBy('o.total_amount', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOrdersByUser(User $user)
    {
        return $this->createQueryBuilder('o')
            ->where('o.purchaser = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }


    //    /**
    //     * @return Order[] Returns an array of Order objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('o.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Order
    //    {
    //        return $this->createQueryBuilder('o')
    //            ->andWhere('o.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
