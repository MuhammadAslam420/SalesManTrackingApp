<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Str;

class categoryService
{
    public function addCategory($name, $logo, $status)
    {
        // Generate a slug based on the category name
        $slug = Str::slug($name,'-');

        $category = new Category();
        $category->name = $name;
        $category->slug = $slug;
        $category->logo = $logo;
        $category->status = $status;
        $category->save();

        return response()->json('success',201);
    }

    public function updateCategory($slug, $name, $logo, $status)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $newslug = Str::slug($name,'-');
        $category->name = $name;
        $category->slug = $newslug;
        if($logo !=NULL){
        $category->logo = $logo;
        }
        $category->status = $status;
        $category->save();

        return response()->json('success',201);
    }
}
