<?php

namespace App\Http\Livewire\Salesman;

use App\Models\Product;
use App\Models\SaleOn;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;

class ShopComponent extends Component
{
    use WithPagination;

    public $sorting = 'asc';
    public $perPage = 10;
    public $search;
    public $cost = 0;
    public $qty =[];

    public function store($productId, $product, $price)
{
    try {
        $quantity = $this->qty[$productId];
         $aproduct = Product::findorFail($productId);
         //dd($aproduct);
        // Check if the product has a discount and if the quantity meets the discount condition
        if ( $quantity >=$aproduct->discount_on_qty) {
            // Calculate the discounted price based on the discount percentage
            $discountedPrice = $price - ($price * $aproduct->discount_percentage / 100);
            $price = $discountedPrice;
            //dd($price);
        }

        Cart::instance('cart')->add($productId, $product, $quantity, $price)->associate('App\Models\Product');
        $this->emitTo('cart-count-component', 'refreshComponent');
        session()->flash('success', 'Product has been added to Cart');
        $this->qty[$productId] = 1;
    } catch (\Exception $e) {
        $errorMessage = $e->getMessage();
        return view('backend.admin.error', compact('errorMessage'));
    }
}

    public function render()
    {
        $products = Product::where('qty', '>', 0)
            ->where('sale_cost', '>', $this->cost)
            ->where('status', 'active')
            ->orderBy('name', $this->sorting)
            ->paginate($this->perPage);
        return view('livewire.salesman.shop-component', ['products' => $products]);
    }
}
