<?php

namespace App\Http\Livewire\Admin\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\ProductExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminProductComponent extends Component
{
    use WithPagination;
    public $search;
    public $perPage=10;
    public $sorting='asc';
    public function exportProduct()
    {
        try{
            return Excel::download(new ProductExport, 'products.xls');
        }catch(\Exception $e)
        {
            $errorMessage= $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function exportProductCsv()
    {
        try{
            return Excel::download(new ProductExport, 'products.csv');
        }catch(\Exception $e)
        {
            $errorMessage= $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }


    public function updateStatus($id,$status)
    {
        try{
            $category = Product::findorFail($id);
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
        $products = Product::search($this->search)->orderBy('id',$this->sorting)->paginate($this->perPage);
        return view('livewire.admin.product.admin-product-component',['products'=>$products]);
    }
}
