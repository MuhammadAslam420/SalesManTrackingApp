<?php

namespace App\Http\Livewire\Admin\Admins;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;

class AdminComponent extends Component
{
    use WithPagination;
    public $search;
    public $perPage=10;
    public $sorting='asc';
    public function updateStatus($id,$status)
    {
        try{
            $category = Admin::findorFail($id);
            $category->status = $status;
            $category->save();
            session()->flash('success','status has been updated');
        }catch(\Exception $e)
        {
            $errorMessage= $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function render()
    {
        $admins = Admin::search($this->search)->orderBy('id',$this->sorting)->paginate($this->perPage);
        return view('livewire.admin.admins.admin-component',['admins'=>$admins]);
    }
}
