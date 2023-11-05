<?php

namespace App\Http\Livewire\Salesman;

use App\Models\Customer;
use App\Models\CustomerBalance;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class PaymentComponent extends Component
{
    public $order_id;
    public $customer_id;
    public $payment;
    public $selectedPaymentOption;

    protected $rules = [
        'order_id' => 'required|exists:orders,id',
        'customer_id' => 'required|exists:customers,id',
        'payment' => 'required|numeric',
        'selectedPaymentOption' => 'required|in:partial,paid'
    ];

    public function paymentAdd()
    {
        $this->validate($this->rules);

        try {
            $order = Order::findOrFail($this->order_id);
            $transact = Transaction::where('order_id', $this->order_id)->first();

            if ($order && $transact->payment_status !== 'completed' && $transact->payment_status !== 'cancelled') {
                $balance = CustomerBalance::where('customer_id', $this->customer_id)
                    ->where('order_id', $this->order_id)
                    ->latest()
                    ->first();

                $bal = new CustomerBalance();
                $bal->customer_id = $this->customer_id;
                $bal->order_id = $this->order_id;
                $bal->salesman_id = auth('salesman')->user()->id;
                $bal->total = $order->total;
                $bal->paid = $this->payment;
                $bal->remaining = $balance ? ($balance->remaining - $this->payment) : ($order->total - $this->payment);
                $bal->save();

                $transaction = Transaction::where('order_id', $this->order_id)->first();
                if ($this->selectedPaymentOption === 'partial') {
                    if ($bal->remaining == 0) {
                        $transaction->payment_status = 'completed';
                    } elseif ($bal->remaining > 0) {
                        $transaction->payment_status = 'partial';
                    }
                } else {
                    $transaction->payment_status = 'completed';
                }
                $transaction->save();

                session()->flash('success', 'Payment has been received');
                $this->reset();
            } else {
                session()->flash('error', 'Payment cannot be processed. Please check the order and payment status.');
            }
        } catch (ModelNotFoundException $e) {
            $errorMessage = 'Order not found';
            return view('backend.admin.error', compact('errorMessage'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }

    public function render()
    {
        $customers = Customer::orderBy('id','asc')->get(['id','username']);
        return view('livewire.salesman.payment-component',['customers'=>$customers]);
    }
}
