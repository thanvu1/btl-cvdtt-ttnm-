<?php

namespace App\Patterns\Factory\Product;

final class PharmaceuticalCosmeticProduct extends ProductEntity
{
    public function __construct(
        ?int   $id,
        string $name,
        float  $price,
        private string $effect
    ) {
        parent::__construct($id, $name, $price);
    }

    public function getType(): string { return 'pharmaceutical_cosmetic'; }

    public function getEffect(): string { return $this->effect; }
}
