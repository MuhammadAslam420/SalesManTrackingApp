@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $customer->username }}</h3>
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
                        <img src="{{ asset('assets/images/faces') }}/{{ $customer->avatar }}" alt="{{ $customer->name }}">
                        <span class="avatar-status bg-success"></span>
                    </div>
                    <span>{{ $customer->username }}</span>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Shop Name</td>
                            <td>{{ $customer->shopname }}</td>
                            <td>Username</td>
                            <td>{{ $customer->username }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $customer->email }}</td>
                            <td>Mobile</td>
                            <td>{{ $customer->mobile }}</td>
                        </tr>
                        <tr>
                            <td>Langitude</td>
                            <td>{{ $customer->lng }}</td>
                            <td>Latitude</td>
                            <td>{{ $customer->lat }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ $customer->city }}</td>
                            <td>Address</td>
                            <td>{{ $customer->address }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td style="text-transform:capitalize;">
                                @if ($customer->status === 'active')
                                    <span class="badge bg-success">{{ $customer->status }}</span>
                                @elseif($customer->status ==='block')
                                    <span class="badge bg-danger">{{ $customer->status }}</span>
                                @else
                                <span class="badge bg-primary">{{ $customer->status }}</span>
                                @endif
                            </td>
                            <td>CreatedBy</td>
                            <td>{{$customer->createdBY->name}}</td>
                        </tr>
                        <tr>
                            <td>Orders</td>
                            <td>{{$customer->orders->count()}}</td>
                            <td>Transactions</td>
                            <td>{{$customer->transactions->count()}}</td>
                        </tr>
                        <tr>
                            <td>Total Amount of Orders</td>
                            <td>{{ $customer->total_orders_sum }}</td>
                            <td>Total Amount Paid</td>
                            <td>{{ $customer->total_balances_sum }}</td>
                        </tr>
                        <tr>
                            <td>Remaining Amount</td>
                            <td>{{$customer->remaining_balances_amount}}</td>
                            <td>Last Transaction</td>
                            <td>{{$customer->last_transactions}}</td>
                        </tr>

                    </table>
                </div>
            </div>

        </section>

    </div>
@endsection
