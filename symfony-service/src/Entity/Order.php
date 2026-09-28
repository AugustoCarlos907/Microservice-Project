<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`orders`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column]
    private int $userId;
 
    #[ORM\Column(length: 255)]
    private string $product;
 
    #[ORM\Column]
    private int $quantity;
 
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private string $totalPrice;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

     #[ORM\Column]
    private \DateTimeImmutable $createdAt;
 
    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

     public function getUserId(): int
    {
        return $this->userId;
    }
 
    public function setUserId(int $userId): static
    {
        $this->userId = $userId;
 
        return $this;
    }
 
    public function getProduct(): string
    {
        return $this->product;
    }
 
    public function setProduct(string $product): static
    {
        $this->product = $product;
 
        return $this;
    }
 
    public function getQuantity(): int
    {
        return $this->quantity;
    }
 
    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;
 
        return $this;
    }
 
    public function getTotalPrice(): string
    {
        return $this->totalPrice;
    }
 
    public function setTotalPrice(string $totalPrice): static
    {
        $this->totalPrice = $totalPrice;
 
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}
