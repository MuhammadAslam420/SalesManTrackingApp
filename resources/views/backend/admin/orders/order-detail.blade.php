@extends('layout.base')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-5 order-md-1 order-last">
                <h3>OrderId {{$order->id}}</h3>
            </div>
            <div class="col-12 col-md-7 order-md-2 order-first">
                @if (Session::has('success'))
                    <span class="alert alert-success alert-dismissible show fade" role="alert"
                        id="success-alert">{{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </span>
                @endif
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.all_orders') }}">Orders</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-green-500 font-extrabold">Order Details</h5>
                        <p>Order ID: {{$order->id}}</p>
                        <p class="text-orange-500 font-extrabold">Customer Name: {{Str::ucfirst($order->customer->username)}}</p>
                        <p class="text-orange-500 font-extrabold">Salesman Name: {{Str::ucfirst($order->salesman->name)}}</p>
                        <p>Status: {{Str::ucfirst($order->status)}}</p>
                        <p>Order Date: {{\Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY')}}</p>
                        <p>Order Delivery Date: {{\Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY')}}</p>
                        <p>Order Subtotal: {{$order->subtotal}} </p>
                        <p>Order Tax: {{$order->tax}}</p>
                        <p>Order Discount: {{$order->discount}}</p>
                        <p>Order Total: {{$order->total}}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Product Details</h5>
                        <table class="table">
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
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->price}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <p class="text-green-500 font-extrabold m-2">Transaction Detail</p>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                                <th>Id</th>
                                <th>Payment Status</th>
                                <th>Payment Mode</th>
                                <th>Transaction Date</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($order->transactions as $transaction)
                            <tr>

                                <td>{{$transaction->id}}</td>
                                <td>{{Str::ucfirst($transaction->payment_status)}}</td>
                                <td>{{Str::ucfirst($transaction->payment_mode)}}</td>
                                <td>{{$transaction->created_at}}</td>
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


@endsection
