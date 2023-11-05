<?php

namespace App\Services;

use App\Models\SubCategory;
use Illuminate\Support\Str;

class subCategoryService
{
    public function addCategory($name, $logo, $status,$category_id)
    {
        // Generate a slug based on the category name
        $slug = Str::slug($name,'-');

        $category = new SubCategory();
        $category->name = $name;
        $category->slug = $slug;
        $category->logo = $logo;
        $category->status = $status;
        $category->category_id = $category_id;
        $category->save();

        return response()->json('success',201);
    }

    public function updateCategory($slug, $name, $logo, $status,$category_id)
    {
        $category = SubCategory::where('slug', $slug)->firstOrFail();
        $newslug = Str::slug($name,'-');
        $category->name = $name;
        $category->slug = $newslug;
        if($logo !=NULL){
        $category->logo = $logo;
        }
        $category->status = $status;
        $category->category_id = $category_id;
        $category->save();

        return response()->json('success',201);
    }
}
