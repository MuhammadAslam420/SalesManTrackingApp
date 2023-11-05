<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCustomerTransactionComponent extends Component
{
    use WithPagination;
    public $sorting='desc';
    public $perPage=12;
    public $search;
    public $customer_id;
    public function mount($customerId)
    {
        $orders=Transaction::search($this->search)
        ->where('customer_id', $this->customer_id)
        ->orderBy('created_at', $this->sorting)
        ->paginate($this->perPage);
        $this->customer_id=$customerId;
    }
    public function render()
    {
        return view('livewire.admin.customers.admin-customer-transaction-component');
    }
}
