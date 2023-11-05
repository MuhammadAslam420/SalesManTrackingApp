<?php

namespace App\Http\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;
    public $search;
    public $perPage=10;
    public $sorting='desc';

    public function updateStatus($id,$status)
    {
        try{
            $category = Category::findorFail($id);
            $category->status = $status;
            $category->save();
            session()->flash('success','Status has been Updated');
        }catch(\Exception $e)
        {
            session()->flash('error',$e->getMessage());
        }
    }

    public function deleteCategory($id)
    {
        try{
            $category = Category::findorFail($id);
            $category->delete();
            session()->flash('success','Status has been Updated');
        }catch(\Exception $e)
        {
            session()->flash('error',$e->getMessage());
        }

    }
    public function render()
    {
        $categories = Category::search($this->search)->orderBy('id',$this->sorting)->paginate($this->perPage);
        return view('livewire.admin.category.admin-category-component',['categories'=>$categories]);
    }
}
