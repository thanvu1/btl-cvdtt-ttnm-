<?php

namespace App\Patterns\Factory\Product;

final class ProductFactory
{
    public static function create(string $type, array $data): ProductEntity
    {
        return match ($type) {
            'medicine'  => new MedicineProduct(
                $data['id']    ?? null,
              $data['name']  ?? '',
             $data['price'] ?? 0,
            $data['dosage'] ?? ''
            ),
            'equipment' => new EquipmentProduct(
                $data['id']    ?? null,
              $data['name']  ?? '',
             $data['price'] ?? 0,
             $data['model'] ?? ''
            ),
            'supplement' => new SupplementProduct(
                $data['id']     ?? null,
              $data['name']   ?? '',
             $data['price']  ?? 0,
             $data['usage']  ?? ''
            ),
            'personal_care' => new PersonalCareProduct(
                $data['id'] ?? null,
              $data['name'] ?? '',
             $data['price'] ?? 0,
          $data['skin_type'] ?? ''
            ),
            'pharmaceutical_cosmetic' => new PharmaceuticalCosmeticProduct(
                $data['id'] ?? null,
              $data['name'] ?? '',
             $data['price'] ?? 0,
            $data['effect'] ?? ''
            ),
            default      => throw new \InvalidArgumentException("Unsupported product type: $type"),
        };
    }
}
