<?php

namespace App\Patterns\Factory\Product;

final class SupplementProduct extends ProductEntity
{
    public function __construct(
        ?int   $id,
        string $name,
        float  $price,
        private string $usage
    ) {
        parent::__construct($id, $name, $price);
    }

    public function getType(): string { return 'supplement'; }

    public function getUsage(): string { return $this->usage; }
}
