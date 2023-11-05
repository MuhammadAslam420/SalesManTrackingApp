<?php

namespace App\Http\Livewire\Salesman;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class OrdersComponent extends Component
{
    use WithPagination;
    public $sorting = 'desc';
    public $perPage = 10;
    public $search;
    public function render()
    {
        $orders = Order::where('salesman_id',auth('salesman')->user()->id)->orderBy('created_at',$this->sorting)->paginate($this->perPage);
        return view('livewire.salesman.orders-component',['orders'=>$orders]);
    }
}
