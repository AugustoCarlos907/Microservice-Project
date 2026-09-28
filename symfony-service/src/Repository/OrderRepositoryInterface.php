<?php

namespace App\Repository;

use App\Entity\Order;

interface OrderRepositoryInterface 
{
    public function findAll(): array;
 
    public function find(int $id): ?Order;
 
    public function save(Order $order): void;
 
    public function delete(Order $order): void;
}
