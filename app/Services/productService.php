<?php

namespace App\Services;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class productService
{
    public function createProduct(Request $request)
    {
        try {
            $slug = Str::slug($request->input('name'), '-');
            $product = new Product();
            //dd($product);
            if ($request->hasFile('image')) {
                $image = Carbon::now()->timestamp . '.' . $request->file('image')->getClientOriginalExtension();
                $request->file('image')->storeAs('assets/images/products', $image);
            }
            $product->name = $request->input('name');
            $product->slug = $slug;
            $product->description = $request->input('description');
            $product->stockIn = $request->input('stockIn');
            $product->qty = $request->input('qty');
            $product->image = $image;
            $product->SKU = $request->input('SKU');
            $product->status = $request->input('status');
            $product->purchase_cost = $request->input('purchase_cost');
            $product->sale_cost = $request->input('sale_cost');
            $product->discount_percentage = $request->input('discount_percentage');
            $product->discount_on_qty = $request->input('discount_on_qty');
            $product->discount_date_start = $request->input('discount_date_start');
            $product->discount_date_end = $request->input('discount_date_end');
            $product->sub_category_id = $request->input('sub_category_id');
            $product->save();
            return response()->json('message', 200);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function editProduct($productId, array $data)
    {
        try {
            $product = Product::findOrFail($productId);

            if (isset($data['image'])) {
                $image = Carbon::now()->timestamp . '.' . $data['image']->getClientOriginalExtension();
                $data['image']->storeAs('assets/images/products', $image);
                $product->image = $image;
            }
            $slug = Str::slug($data['name'], '-');

            $product->name = $data['name'];
            $product->slug = $slug;
            $product->description = $data['description'];
            $product->stockIn = $data['stockIn'];
            $product->qty = $data['qty'];
            $product->SKU = $data['SKU'];
            $product->status = $data['status'];
            $product->purchase_cost = $data['purchase_cost'];
            $product->sale_cost = $data['sale_cost'];
            $product->discount_percentage = $data['discount_percentage'];
            $product->discount_on_qty = $data['discount_on_qty'];
            $product->discount_date_start = $data['discount_date_start'];
            $product->discount_date_end = $data['discount_date_end'];
            $product->sub_category_id = $data['sub_category_id'];
            $product->save();
            return response()->json(['message' => 'Product updated successfully'], 200);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

}
