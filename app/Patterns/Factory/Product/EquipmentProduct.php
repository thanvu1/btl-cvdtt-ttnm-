<?php

namespace App\Patterns\Factory\Product;

final class EquipmentProduct extends ProductEntity
{
    public function __construct(
        ?int   $id,
        string $name,
        float  $price,
        private string $model
    ) {
        parent::__construct($id, $name, $price);
    }

    public function getType(): string  { return 'equipment'; }
    public function getModel(): string { return $this->model; }
}
