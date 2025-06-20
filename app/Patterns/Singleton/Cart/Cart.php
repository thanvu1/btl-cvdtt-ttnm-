<?php

namespace App\Patterns\Singleton\Cart;

class Cart
{
    private static $instance = null;
    private $items = [];

    private function __construct()
    {
        // Khởi tạo từ session nếu có
        $this->items = session()->get('cart', []);
        // logger('Cart constructor gọi'); 
    }

    public static function getInstance(): Cart
    {
        if (self::$instance === null) {
            self::$instance = new Cart();
        }

        return self::$instance;
    }

    public function add($productId, $name, $price, $qty = 1, $image = null): void
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId]['qty'] += $qty;
        } else {
            $this->items[$productId] = [
                'name' => $name,
                'price' => $price,
                'qty' => $qty,
                'image' => $image
            ];
        }

        $this->save();
    }

    public function remove($productId): void
    {
        unset($this->items[$productId]);
        $this->save();
    }

    public function update($productId, $qty): void
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId]['qty'] = $qty;
            $this->save();
        }
    }

    public function all(): array
    {
        return $this->items;
    }

    public function total(): int
    {
        return collect($this->items)->sum(fn($item) => $item['price'] * $item['qty']);
    }

    private function save(): void
    {
        session()->put('cart', $this->items);
    }

    public function clear(): void
    {
        $this->items = [];
        session()->forget('cart');
        self::$instance = null;
    }

    public function restore(array $items): void
    {
        $this->items = $items;
        $this->save();
    }

}
