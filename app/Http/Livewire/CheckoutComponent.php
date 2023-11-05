<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\CustomerBalance;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Transaction;
use Cart;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CheckoutComponent extends Component
{
    public $selectedPaymentOption;
    public $partial_amount;
    public $deliveryDate;
    public $selectedUserId;
    protected $rules = [
        'selectedUserId' => 'required|exists:customers,id',
        'partial_amount' => 'nullable|numeric',
        'selectedPaymentOption' => 'required|in:paid,on_delivery,partial',
        'deliveryDate' => 'required|date',
    ];

    public function checkout()
    {
        $this->validate();
        //dd('hello');

        try {
            if (!Cart::instance('cart')->count()) {
                throw new \Exception('Cart is empty');
            }

            DB::beginTransaction();

            $order = new Order();
            $order->customer_id = $this->selectedUserId;
            $order->delivery_date = $this->deliveryDate;
            $order->status = 'pending';
            $order->total = Cart::total();
            $order->tax = Cart::tax();
            $order->subtotal = Cart::subtotal();
            $order->salesman_id = auth('salesman')->user()->id;
            $order->salesman_commission = (Cart::total() * auth('salesman')->user()->pay->commission_on_sales / 100);
            $order->save();
            //dd($order);

            // Create order items
            foreach (Cart::instance('cart')->content() as $cartItem) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->product_id = $cartItem->id;
                $orderItem->qty = $cartItem->qty;
                $orderItem->price = $cartItem->price;
                $orderItem->save();
            }
            // Create transaction record
            $transaction = new Transaction();
            $transaction->order_id = $order->id;
            $transaction->total = Cart::instance('cart')->total();
            if ($this->selectedPaymentOption === 'partial') {
                $transaction->payment_status = $this->selectedPaymentOption;
            } elseif ($this->selectedPaymentOption === 'paid') {
                $transaction->payment_status = 'paid';
            } else {
                $transaction->payment_status = 'pending';
            }
            $transaction->payment_mode = $this->selectedPaymentOption;
            $transaction->customer_id = $this->selectedUserId;
            $transaction->save();
           // dd($transaction);
            // Create customer balance record
            $customerBalance = new CustomerBalance();
            $customerBalance->customer_id = $this->selectedUserId;
            $customerBalance->order_id = $order->id;
            $customerBalance->salesman_id = auth('salesman')->user()->id;
            $customerBalance->total = Cart::instance('cart')->total();
            //dd('hell');
            if ($this->selectedPaymentOption != 'on_delivery') {
                $customerBalance->paid = ($this->selectedPaymentOption === 'paid') ? $customerBalance->total : $this->partial_amount;
                $customerBalance->remaining = $customerBalance->total - $customerBalance->paid;
            } elseif ($this->selectedPaymentOption === 'on_delivery') {
                $customerBalance->paid = 0;
                $customerBalance->remaining = $customerBalance->total;
            }

            //dd('yes');
            $customerBalance->save();


            DB::commit();
            //dd('yes');
            foreach(Cart::instance('cart')->content() as $item){
                $product = Product::findorFail($item->id);
                $product->qty = $product->qty - $item->qty;
                $product->sale_qty += $item->qty;
                $product->save();
           }
            // Clear the cart
            Cart::instance('cart')->destroy();

            // Redirect or show success message
            session()->flash('success', 'Order placed successfully!');
            return redirect()->route('salesman.dashboard');
        } catch (\Exception $e) {
            DB::rollback();
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function render()
    {
        $customers = Customer::where('status', 'active')->get(['id', 'shopname', 'username']);
        return view('livewire.checkout-component', ['customers' => $customers]);
    }
}
