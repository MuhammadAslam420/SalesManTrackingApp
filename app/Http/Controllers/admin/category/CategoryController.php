<?php

namespace App\Http\Controllers\admin\category;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\CreateCategoryRequest;
use App\Http\Requests\admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Services\categoryService;
use Carbon\Carbon;

class CategoryController extends Controller
{
    public function index()
    {
        try {
            return view('backend.admin.category.index');
        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function create()
    {
        try {
            return view('backend.admin.category.create');
        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function storeCategory(CreateCategoryRequest $request, categoryService $categoryService)
    {
        $request->validated();
        try {
            $name = $request->input('name');
            $status = $request->input('status');

            if ($request->hasFile('logo')) {
                $logo = Carbon::now()->timestamp . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->storeAs('assets/images/category', $logo);
            }

            // Call the addCategory method from the CategoryService
            $categoryService->addCategory($name, $logo, $status);
            return back()->with('message', 'Category added successfully');
        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function edit($slug)
    {
        try {
            $category = Category::where('slug', $slug)->first();
            return view('backend.admin.category.edit', compact('category'));
        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function update(UpdateCategoryRequest $request, CategoryService $categoryService, $slug)
    {
        $request->validated();
        try {
            $name = $request->input('name');
            $status = $request->input('status');
            $logo = null;

            if ($request->hasFile('logo')) {
                $logo = Carbon::now()->timestamp . '.' . $request->file('logo')->getClientOriginalExtension();
                $request->file('logo')->storeAs('assets/images/category', $logo);
            }

            // Call the updateCategory method from the CategoryService
            $categoryService->updateCategory($slug, $name, $logo, $status);

            return redirect()->route('admin.categories')->with('message', 'Category updated successfully');
        }catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

}
