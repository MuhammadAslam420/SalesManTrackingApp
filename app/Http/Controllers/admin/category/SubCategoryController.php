<?php

namespace App\Http\Controllers\admin\category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\subCategoryService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\admin\CreateSubCategoryRequest;
use App\Http\Requests\admin\UpdateSubCategoryRequest;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    public function index()
    {
        try {
            return view('backend.admin.subcategory.index');
        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function create()
    {
        try {
            $categories = Category::get(['id','name']);
            //dd($categories);
            return view('backend.admin.subcategory.create',compact('categories'));
        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

    }
    public function store(CreateSubCategoryRequest $request,subCategoryService $subcategoryservice)
    {
        $request->validated();
        try {
            $name = $request->input('name');
            $status = $request->input('status');
            $category_id = $request->input('category_id');

            if ($request->hasFile('logo')) {
                $logo = Carbon::now()->timestamp . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->storeAs('assets/images/subcategory', $logo);
            }

            // Call the addCategory method from the CategoryService
            $subcategoryservice->addCategory($name, $logo, $status,$category_id);
            return back()->with('message', 'Category added successfully');
        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function edit($slug)
    {
        try {
            $subcategory = SubCategory::where('slug',$slug)->firstOrFail();
            $categories = Category::get(['id','name']);
            //dd($categories);
            return view('backend.admin.subcategory.edit',compact('categories','subcategory'));
        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function update(UpdateSubCategoryRequest $request,subCategoryService $subcategoryservice,$slug)
    {
        $request->validated();
        try {
            $name = $request->input('name');
            $status = $request->input('status');
            $category_id = $request->input('category_id');
            $logo = null;

            if ($request->hasFile('logo')) {
                $logo = Carbon::now()->timestamp . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->storeAs('assets/images/subcategory', $logo);
            }

            // Call the updateCategory method from the CategoryService
            $subcategoryservice->updateCategory($slug, $name, $logo, $status,$category_id);

            return redirect()->route('admin.sub_categories')->with('message', 'Category updated successfully');
        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
}
