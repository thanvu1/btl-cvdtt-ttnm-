<?php

namespace App\Patterns\Factory\Product;

final class PersonalCareProduct extends ProductEntity
{
    public function __construct(
        ?int   $id,
        string $name,
        float  $price,
        private string $skinType
    ) {
        parent::__construct($id, $name, $price);
    }

    public function getType(): string { return 'personal_care'; }

    public function getSkinType(): string { return $this->skinType; }
}
