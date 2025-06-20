<?php

namespace App\Patterns\Factory\Product;

final class MedicineProduct extends ProductEntity
{
    public function __construct(
        ?int   $id,
        string $name,
        float  $price,
        private string $dosage
    ) {
        parent::__construct($id, $name, $price);
    }

    public function getType(): string  { return 'medicine'; }
    public function getDosage(): string { return $this->dosage; }
}
