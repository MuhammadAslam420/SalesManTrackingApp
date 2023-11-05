@extends('layout.base')
@push('styles')
    <style>
        #map {
            height: 400px;
        }
    </style>
@endpush
@section('content')
    <div class="page-heading">
        <h3>Admin Dashboard Sales Statistics</h3>
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
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Products</h6>
                                        <h6 class="font-extrabold mb-0">{{ $products }}</h6>
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
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Orders</h6>
                                        <h6 class="font-extrabold mb-0">{{ $orders }}</h6>
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
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Sale</h6>
                                        <h6 class="font-extrabold mb-0">{{ $sales }}</h6>
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
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Categories</h6>
                                        <h6 class="font-extrabold mb-0">{{ $categories }}</h6>
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
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Admin</h6>
                                        <h6 class="font-extrabold mb-0">{{ $admins }}</h6>
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
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Customers</h6>
                                        <h6 class="font-extrabold mb-0">{{ $customers }}</h6>
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
                                            <i class="iconly-boldAdd-User"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Salesman</h6>
                                        <h6 class="font-extrabold mb-0">{{ $salesman }}</h6>
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
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">SubCategories</h6>
                                        <h6 class="font-extrabold mb-0">{{ $sub_categories }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Salesman Today Live Activity Tracking</h4>
                            </div>
                            <div class="card-body">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-4">
                        <div class="card">
                            <div class="card-header">
                                <h4>Saleman Today Sales</h4>
                            </div>
                            <div class="card-body">
                                @forelse ($salesman_sales as $sale)
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-primary" width="32" height="32" fill="blue"
                                                    style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">{{ $sale->salesman->name }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">{{ $sale->total }}</h5>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-primary" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Europe</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">862</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-success" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">America</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">375</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                    style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Indonesia</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">1025</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-primary" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Europe</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">862</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-success" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">America</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">375</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                    style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Indonesia</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">1025</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-primary" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Europe</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">862</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-success" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">America</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">375</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                    style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Indonesia</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">1025</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-primary" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Europe</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">862</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-success" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">America</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">375</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                    style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Indonesia</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">1025</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-primary" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Europe</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">862</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-success" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">America</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">375</h5>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-danger" width="32" height="32" fill="blue"
                                                    style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Indonesia</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">1025</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center">
                                                <svg class="bi text-primary" width="32" height="32"
                                                    fill="blue" style="width:10px">
                                                    <use
                                                        xlink:href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill') }}" />
                                                </svg>
                                                <h5 class="mb-0 ms-3">Europe</h5>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <h5 class="mb-0">862</h5>
                                        </div>

                                    </div>

                                @endforelse

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-8">
                        <div class="card">
                            <div class="card-header">
                                <h4>Recent Visited Customers</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-lg">
                                        <thead>
                                            <tr>
                                                <th>Shop</th>
                                                <th>Time</th>
                                                <th>By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($today_visits as $today)
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <img src="{{ asset('assets/images/faces') }}/{{$today->customer->avatar}}">
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0">{{$today->customer->username}}</p>
                                                        </div>
                                                    </td>
                                                    <td>{{\Carbon\Carbon::parse($today->created_at)->isoFormat('H M S')}}</td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">{{$today->salesman->name}}</p>
                                                    </td>

                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <img src="{{ asset('assets/images/faces/5.jpg') }}">
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">Congratulations on your graduation!</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <img src="{{ asset('assets/images/faces/5.jpg') }}">
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">Congratulations on your graduation!</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <img src="{{ asset('assets/images/faces/2.jpg') }}">
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">Wow amazing design! Can you make another
                                                            tutorial for
                                                            this design?</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <img src="{{ asset('assets/images/faces/5.jpg') }}">
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">Congratulations on your graduation!</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="col-3">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar avatar-md">
                                                                <img src="{{ asset('assets/images/faces/2.jpg') }}">
                                                            </div>
                                                            <p class="font-bold ms-3 mb-0">Si Ganteng</p>
                                                        </div>
                                                    </td>
                                                    <td class="col-auto">
                                                        <p class=" mb-0">Wow amazing design! Can you make another
                                                            tutorial for
                                                            this design?</p>
                                                    </td>
                                                </tr>
                                            @endforelse

                                        </tbody>
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
                                <img src="{{ asset('assets/images/faces') }}/{{ auth('admin')->user()->avatar }}"
                                    alt="Face 1">
                            </div>
                            <div class="ms-3 name">
                                <h5 class="font-bold" style="font-size:15px;">{{ auth('admin')->user()->name }}</h5>
                                <h6 class="text-muted mb-0" style="font-size: 11px;">{{ auth('admin')->user()->mobile }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Salesman on Duty</h4>
                    </div>
                    <div class="card-content pb-4">
                        @forelse ($salesman_duty as $salesman)
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('assets/images/faces') }}/{{ $salesman->avatar }}">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">{{ $salesman->name }}</h5>
                                    <h6 class="text-muted mb-0">{{ $salesman->mobile }}</h6>
                                </div>
                            </div>
                        @empty
                            <div class="recent-message d-flex px-4 py-3">
                                <div>
                                    <img src="{{ asset('assets/images/bg/4853433.png') }}" width="200"
                                        class="img-thumbnail">
                                </div>
                            </div>
                        @endforelse
                        <div class="px-4">
                            <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Start Track</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Orders</h4>
                    </div>
                    <div class="card-content pb-4">
                        @forelse ($recent_orders as $order)
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('assets/images/faces') }}/{{ $order->customer->avatar }}">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1">{{ $order->customer->username }}</h5>
                                    <h6 class="text-muted mb-0">{{ $order->total }}</h6>
                                </div>
                            </div>
                        @empty
                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="{{ asset('assets/images/bg/4853433.png') }}">
                                </div>
                            </div>
                        @endforelse
                        <div class="px-4">
                            <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>View Orders</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        function initMap() {
    // Create a map object
    var map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 30.3753, lng: 69.3451 }, // Set the initial map center
        zoom: 10 // Set the initial map zoom level
    });

    @foreach ($polylines as $salesmanId => $salesmanData)
        // Create a polyline for each salesman
        var polyline = new google.maps.Polyline({
            path: {!! json_encode($salesmanData['coordinates']) !!},
            geodesic: true,
            strokeColor: '#FF0000', // Set the color of the polyline
            strokeOpacity: 1.0,
            strokeWeight: 2
        });

        // Set the polyline on the map
        polyline.setMap(map);

        // Add a marker with the salesman's name at the start of the polyline
        var marker = new google.maps.Marker({
            position: polyline.getPath().getAt(0),
            map: map,
            title: {!! json_encode($salesmanData['name']) !!},
            label: {!! json_encode($salesmanData['name']) !!},
            zIndex: 9999
        });
    @endforeach
}

function refreshMap() {
    // Clear the existing map and polylines
    document.getElementById('map').innerHTML = '';

    // Call the initMap() function to redraw the map and polylines
    initMap();
}

window.onload = function() {
    initMap();

    // Refresh the map every minute
    setInterval(refreshMap, 60000);
};

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKE74qyuQZ0ctAAZoEsLGjGQGf6XcE3PU&callback=initMap">
    </script>
    <script>
        function updateCoordinates() {
            // Make an AJAX request to fetch the updated coordinates
            $.ajax({
                url: 'admin/dashboard', // Replace with your backend route to fetch the updated coordinates
                method: 'GET',
                success: function(response) {
                    // Process the updated coordinates and redraw the polylines
                    var polylinesData = response
                    .polylines; // Assuming the response contains the updated coordinates
                    redrawPolylines(polylinesData);
                },
                error: function(error) {
                    console.log('Error occurred while fetching coordinates:', error);
                }
            });
        }
    </script>
@endpush
