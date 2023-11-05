<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Exports\OrderExport;
use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
class AdminOrdersComponent extends Component
{
    use WithPagination;
    public $search;
    public $sorting='asc';
    public $perPage = 10;
    public $activeTab = null;
    public function exportOrder()
    {
        try{
            return Excel::download(new OrderExport, 'orders.xls');
        }catch(\Exception $e)
        {
            $errorMessage= $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function exportOrderCsv()
    {
        try{
            return Excel::download(new OrderExport, 'orders.csv');
        }catch(\Exception $e)
        {
            $errorMessage= $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }

    public function updateStatus($id,$status){
        try{
            $order = Order::findorFail($id);
            $order->status = $status;
            $order->save();
            session()->flash('success','Order Status Has Been Updated Successfully');
        }catch(\Exception $e){
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function render()
    {
        $query = Order::search($this->search)->orderBy('created_at', $this->sorting);

        if ($this->activeTab) {
            $query->where('status', $this->activeTab);
        }

        $orders = $query->paginate($this->perPage);

        return view('livewire.admin.orders.admin-orders-component', ['orders' => $orders]);
    }
}
