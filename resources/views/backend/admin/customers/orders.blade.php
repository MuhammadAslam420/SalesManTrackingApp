@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-7 order-md-1 order-last">
                    <h3>{{$customer->username}} Balance Sheet</h3>
                </div>
                <div class="col-12 col-md-5 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.view_all_customers')}}">Customers</a></li>
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$customer->username}} Balance sheet</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
       @livewire('admin.customers.admin-customer-orders-component',['customerId' => $customer->id])
    </div>
    @endsection
