<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;

class CartCountComponent extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh'];



    public function render()
    {
        return view('livewire.cart-count-component');
    }
}
