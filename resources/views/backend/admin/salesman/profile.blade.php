@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ $salesman->name }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.salesmen') }}">Salesmen</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $salesman->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="avatar avatar-xl bg-warning me-3">
                        <img src="{{ asset('assets/images/faces') }}/{{ $salesman->avatar }}" alt="{{ $salesman->name }}">
                        <span class="avatar-status bg-success"></span>
                    </div>
                    <span>{{ $salesman->name }}</span>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td>Employee No</td>
                            <td>{{ $salesman->employee_no }}</td>
                            <td>Username</td>
                            <td>{{ $salesman->username }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $salesman->email }}</td>
                            <td>Mobile</td>
                            <td>{{ $salesman->mobile }}</td>
                        </tr>
                        <tr>
                            <td>Langitude</td>
                            <td>{{ $salesman->lng }}</td>
                            <td>Latitude</td>
                            <td>{{ $salesman->lat }}</td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>{{ $salesman->city }}</td>
                            <td>Address</td>
                            <td>{{ $salesman->address }}</td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td style="text-transform:capitalize;">
                                @if ($salesman->status === 'active')
                                    <span class="badge bg-success">{{ $salesman->status }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $salesman->status }}</span>
                                @endif
                            </td>
                            <td>ON Duty</td>
                            <td style="text-transform:capitalize;">
                                @if ($salesman->online === 'online')
                                    <span class="badge bg-success">{{ $salesman->online }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $salesman->online }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Basic Pay</td>
                            <td>{{ $salesman->pay->basic }}</td>
                            <td>Annual Increment</td>
                            <td>{{ $salesman->pay->annual_increment }} %</td>
                        </tr>
                        <tr>
                            <td>Medical Allowance</td>
                            <td>{{ $salesman->pay->medical }}</td>
                            <td>Transport Allowance</td>
                            <td>{{ $salesman->pay->transport }}</td>
                        </tr>
                        <tr>
                            <td>Annual Bonus</td>
                            <td>{{ $salesman->pay->annual_bonus }}</td>
                            <td>Commission On Sales</td>
                            <td>{{ $salesman->pay->commission_on_sales }} %</td>
                        </tr>

                    </table>
                    <div class="responsive-table mt-5">
                        <h1>Routes</h1>
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>RouteID</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Visit Day</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ( $salesman->routes as $route)
                                <tr>
                                    <td>{{$route->id}}</td>
                                    <td>{{$route->name}}</td>
                                    <td><span class="badge bg-success" style="text-transform: capitalize;">{{$route->status}}</span></td>
                                    <td><span style="text-transform:capitalize;">{{$route->visit_day}}</span></td>
                                    <td><a href="#" class="btn btn-success"><span>View Detail</span></a></td>
                                </tr>
                                @empty
                                 <tr>
                                    <div>
                                        <img src="{{asset('assets/images/samples/error-403.png')}}" width="500" alt="no-record-found">
                                    </div>
                                 </tr>
                                @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="responsive-table mt-5">
                        <h1>Orders</h1>
                        <table class="table table-stripped">
                            <thead>
                                <tr>
                                    <th>OrderID</th>
                                    <th>Shop</th>
                                    <th>Address</th>
                                    <th>Tax</th>
                                    <th>Discount</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                    <th>Order Date</th>
                                    <th>Delivery Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($salesman->orders as $order )
                                <tr>
                                    <td>{{$order->id}}</td>
                                    <td>{{$order->customer->shopname}}</td>
                                    <td>{{$order->customer->address}}</td>
                                    <td>{{$order->tax}}</td>
                                    <td>{{$order->discount}}</td>
                                    <td>{{$order->subtotal}}</td>
                                    <td>{{\Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY')}}</td>
                                    <td>{{\Carbon\Carbon::parse($order->delivery_date)->isoFormat("MMM Do YYYY")}}</td>
                                    <td>{{$order->status}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <div>
                                        <img src="{{asset('assets/images/samples/error-403.png')}}" width="500" alt="">
                                    </div>
                                </tr>

                                @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection
