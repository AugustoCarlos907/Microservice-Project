<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository implements OrderRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function findAll(): array
    {
        return $this->createQueryBuilder('o')
            ->orderBy('o.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
 
    public function find($id, $lockMode = null, $lockVersion = null): ?Order
    {
        return parent::find($id, $lockMode, $lockVersion);
    }
 
    public function save(Order $order): void
    {
        $em = $this->getEntityManager();
        $em->persist($order);
        $em->flush();
    }
 
    public function delete(Order $order): void
    {
        $em = $this->getEntityManager();
        $em->remove($order);
        $em->flush();
    }
}
