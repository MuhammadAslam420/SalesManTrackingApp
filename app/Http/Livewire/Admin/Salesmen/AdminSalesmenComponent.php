<?php

namespace App\Http\Livewire\Admin\Salesmen;

use Livewire\Component;
use App\Models\Salesman;
use Livewire\WithPagination;
use Carbon\Carbon;

class AdminSalesmenComponent extends Component
{
    use WithPagination;
    public $search;

    public function updateStatus($id,$status)
    {
       try{
        $salesman= Salesman::findorFail($id);
        $salesman->status = $status;
        $salesman->save();
        session()->flash('message','Status has been updated successfully!');
       }catch(\Exception $e)
       {
         session()->flash('error',$e->getMessage());
       }
    }
    public function render()
    {
        $salesmen = Salesman::search($this->search)->sortable()->paginate(10);
        return view('livewire.admin.salesmen.admin-salesmen-component',['salesmen'=>$salesmen]);
    }
}
