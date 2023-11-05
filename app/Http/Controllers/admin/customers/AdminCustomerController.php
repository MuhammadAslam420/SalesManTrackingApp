<?php

namespace App\Http\Controllers\admin\customers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Services\customerService;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index()
    {
        try {
            return view('backend.admin.customers.index');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function create()
    {
        try {
            return view('backend.admin.customers.create');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function store(Request $request)
    {
        try {

            $cutomerservice = new customerService;
            $cutomerservice->createCutomer($request);
            return back()->with('message', 'Customer has been Updated');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function edit($id)
    {
        try {
            $customer = Customer::findorFail($id);
            return view('backend.admin.customers.edit', compact('customer'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function update(Request $request)
    {
        try {
            if ($request->has('id')) {
                $customerService = new customerService();
                $customerService->customerUpdate($request);
            }
            return back()->with('message', 'Customer has been created successfully');
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

    }
    public function profile($id)
    {
        try {
            $customer = Customer::findorFail($id);
            return view('backend.admin.customers.profile', compact('customer'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function balance($id)
    {
        try {
            $customer = Customer::findorFail($id);
            return view('backend.admin.customers.balance', compact('customer'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function orders($id)
    {
        try {
            $customer = Customer::findorFail($id);
            return view('backend.admin.customers.orders', compact('customer'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function transactions($id)
    {
        try {
            $customer = Customer::findorFail($id);
            return view('backend.admin.customers.transactions', compact('customer'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function orderDetail($orderId)
    {
        try {
            $order = Order::findorFail($orderId);
            return view('backend.admin.customers.order_detail', compact('order'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }
    }
    public function customerMap($id)
    {
        try {
            $customer = Customer::findorFail($id);
            return view('backend.admin.customers.map', compact('customer'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            return view('backend.admin.error', compact('errorMessage'));
        }

    }
}
