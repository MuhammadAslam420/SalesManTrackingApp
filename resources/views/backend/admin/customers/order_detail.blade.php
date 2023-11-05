@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $order->customer->shopname }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.view_all_customers') }}">Customers</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $customer->username }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="avatar avatar-xl bg-warning me-3">
                        <img src="{{ asset('assets/images/faces') }}/{{ $order->customer->avatar }}" alt="{{ $customer->name }}">
                        <span class="avatar-status bg-success"></span>
                    </div>
                    <span>{{ $order->customer->username }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <h1>Order Details</h1>

                        <h2>Customer Information</h2>
                        <p>Customer Name: {{ $order->customer->name }}</p>
                        <p>Customer Email: {{ $order->customer->email }}</p>
                        <p>Customer Mobile: {{ $order->customer->mobile }}</p>
                        <p>Customer Address: {{ $order->customer->address }}</p>

                        <h2>Order Information</h2>
                        <p>Order ID: {{ $order->id }}</p>
                        <p>Delivery Date: {{ $order->delivery_date }}</p>
                        <p>Status: {{ $order->status }}</p>
                        <p>Total: {{ $order->total }}</p>
                        <p>Tax: {{ $order->tax }}</p>
                        <p>Subtotal: {{ $order->subtotal }}</p>
                        <p>Discount: {{ $order->discount }}</p>

                    </div>
                    <div class="row">
                        <h2>Order Items</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h2>Transaction Details</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Total</th>
                                    <th>Payment Status</th>
                                    <th>Payment Mode</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->total }}</td>
                                        <td>{{ $transaction->payment_status }}</td>
                                        <td>{{ $transaction->payment_mode }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection
