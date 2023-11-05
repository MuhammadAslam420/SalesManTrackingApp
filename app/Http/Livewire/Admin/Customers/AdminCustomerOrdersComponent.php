<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCustomerOrdersComponent extends Component
{
    use WithPagination;
    public $sorting='desc';
    public $perPage=12;
    public $search;
    public $customer_id;
    public function mount($customerId)
    {
        $this->customer_id=$customerId;
    }
    public function render()
    {
        $orders=Order::search($this->search)
        ->where('customer_id', $this->customer_id)
        ->orderBy('created_at', $this->sorting)
        ->paginate($this->perPage);
        return view('livewire.admin.customers.admin-customer-orders-component',['orders'=>$orders]);
    }
}
