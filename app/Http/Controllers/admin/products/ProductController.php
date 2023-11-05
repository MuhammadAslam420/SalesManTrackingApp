<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CreateProductRequest;
use App\Http\Requests\admin\UpdateProductRequest;
use App\Models\Product;
use App\Models\SubCategory;
use App\Services\productService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(productService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        try{
            return view('backend.admin.products.index');
        }catch(\Exception $e)
        {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }

    public function create()
    {
        try{
            $subcategories = SubCategory::get(['id','name']);
            return view('backend.admin.products.create',compact('subcategories'));
        }catch(\Exception $e)
        {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }



    public function store(CreateProductRequest $request)
    {
        try {
             $request->validated();
            $this->productService->createProduct($request);
            return back()->with('message', 'Product has been added successfully');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function edit($productId)
    {
        try{
            $product = Product::findorFail($productId);
            $subcategories = SubCategory::get(['id','name']);
            return view('backend.admin.products.edit',compact('product','subcategories'));
        }catch(\Exception $e)
        {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error',compact('errorMessage'));
        }
    }
    public function update(UpdateProductRequest $request, $productId)
    {
        $request->validated();
       try{
          $this->productService->editProduct($productId,$request->all());
          return back()->with('message','product has been updated successfully');
       }catch(\Exception $e)
       {
           $errorMessage = $e->getMessage();
           return view('backend.admin.error',compact('errorMessage'));
       }
    }
}
