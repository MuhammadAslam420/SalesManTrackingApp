<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Models\Customer;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCustomerComponent extends Component
{
    use WithPagination;
    public $search;
    public $perPage = 5;
    public $sorting = 'desc';

    public function updateStatus($id, $status)
    {
        try {
            $customer = Customer::findorFail($id);
            $customer->status = $status;
            if($status === 'block')
            {
                $customer->deleted_at = Carbon::today();
            }
            $customer->save();
            session()->flash('success', 'Status has been updated');

        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
    public function render()
    {
        $customers = Customer::search($this->search)->orderBy('created_at', $this->sorting)->paginate($this->perPage);
        return view('livewire.admin.customers.admin-customer-component', ['customers' => $customers]);
    }
}
