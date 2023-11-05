<?php

namespace App\Http\Livewire\Admin\Subcategory;

use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminSubCategoryComponent extends Component
{
    use WithPagination;
    public $search;
    public $perPage=10;
    public $sorting='desc';

    public function updateStatus($id,$status)
    {
        try{
            $category = SubCategory::findorFail($id);
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
            $category = SubCategory::findorFail($id);
            $category->delete();
            session()->flash('success','Status has been Updated');
        }catch(\Exception $e)
        {
            session()->flash('error',$e->getMessage());
        }

    }
    public function render()
    {
        $subcategories = SubCategory::search($this->search)->orderBy('id',$this->sorting)->paginate($this->perPage);
        return view('livewire.admin.subcategory.admin-sub-category-component',['subcategories'=>$subcategories]);
    }
}
