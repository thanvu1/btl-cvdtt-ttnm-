<?php

namespace App\Patterns\Factory\Product;

abstract class ProductEntity
{
    public function __construct(
        protected ?int   $id,
        protected string $name,
        protected float  $price
    ) {}

    abstract public function getType(): string;

    public function getId(): ?int     { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getPrice(): float { return $this->price; }
}
