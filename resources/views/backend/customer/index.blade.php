@extends('layout.customer')
@section('content')

<div class="page-heading">
    <h3>Customer Dashboard</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon purple">
                                        <i class="bi bi-gift"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Orders</h6>
                                    <h6 class="font-extrabold mb-0">{{auth('customer')->user()->orders->count()}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon blue">
                                        <i class="bi bi-gift"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Today Orders</h6>
                                    <h6 class="font-extrabold mb-0">{{auth('customer')->user()->orders->where('created_at',\Carbon\Carbon::today())->count()}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon green">
                                        <i class="bi bi-cash"></i>
                                     </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Pending</h6>
                                    <h6 class="font-extrabold mb-0">{{ auth('customer')->user()->orders->sum('total') - auth('customer')->user()->balances->sum('paid')}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body px-3 py-4-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="stats-icon red">
                                        <i class="bi bi-cash"></i>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h6 class="text-muted font-semibold">Paid Amount</h6>
                                    <h6 class="font-extrabold mb-0">{{auth('customer')->user()->balances->sum('paid')}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Orders</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>OrderID</th>
                                            <th>OrderDate</th>
                                            <th>Salesman</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse(auth('customer')->user()->orders->take(10) as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{\Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY')}}</td>
                                            <td>{{$order->salesman->name}}</td>
                                            <td>{{$order->total}}</td>
                                            <td><a href="#" class="btn btn-primary">Order Detail</a></td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <img src="{{asset('assets/images/bg/4853433.png')}}" alt="">
                                        </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <a href="#" class="btn btn-primary float-right">All Orders</a>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="{{asset('assets/images/faces/1.jpg')}}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold" >{{ auth('customer')->user()->username }}</h5>
                            <h6 class="text-muted mb-0" >{{ auth('customer')->user()->mobile }}</h6>

                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Payment History</h4>
                </div>
                <div class="card-content pb-4">
                    @forelse (auth('customer')->user()->balances->take(10) as $balance)
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="name ms-4">
                            <h5 class="mb-1">{{$balance->total}}</h5>
                            <h6 class="text-muted mb-0">{{$balance->paid}}</h6>
                        </div>
                    </div>
                    @empty
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{asset('assets/images/bg/4853433.png')}}">
                        </div>
                    </div>
                    @endforelse
                    <div class="px-4">
                        <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>View Payments</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

