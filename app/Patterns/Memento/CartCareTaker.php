<?php
namespace App\Patterns\Memento;
use App\Patterns\Singleton\Cart\Cart;
use App\Patterns\Memento\CartMemento;

class CartCaretaker
{
    public function save(Cart $cart): CartMemento
    {
        return new CartMemento($cart->all());
    }

    public function restore(Cart $cart, CartMemento $memento): void
    {
        $cart->restore($memento->getState());
    }
}
