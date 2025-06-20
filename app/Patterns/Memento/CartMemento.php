<?php
namespace App\Patterns\Memento;

class CartMemento
{
    protected array $state;

    public function __construct(array $state)
    {
        $this->state = $state;
    }

    public function getState(): array
    {
        return $this->state;
    }
}
