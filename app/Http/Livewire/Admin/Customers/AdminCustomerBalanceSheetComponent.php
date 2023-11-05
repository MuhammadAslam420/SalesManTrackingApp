<?php

namespace App\Http\Livewire\Admin\Customers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CustomerBalance;
class AdminCustomerBalanceSheetComponent extends Component
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
        $balances = CustomerBalance::search($this->search)
        ->where('customer_id', $this->customer_id)
        ->orderBy('created_at', $this->sorting)
        ->paginate($this->perPage);
            return view('livewire.admin.customers.admin-customer-balance-sheet-component',['balances'=>$balances]);
    }
}
