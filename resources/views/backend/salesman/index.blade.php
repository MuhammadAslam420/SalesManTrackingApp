@extends('layout.salesman')
@section('content')
<div class="page-heading">
    <h3>Salesman Dashboard Sales Statistics</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-9">
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
                                    <h6 class="font-extrabold mb-0">{{auth('salesman')->user()->orders->count()}}</h6>
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
                                    <h6 class="font-extrabold mb-0">
                                        {{auth('salesman')->user()->orders->where('created_at',\Carbon\Carbon::today())->count()}}
                                    </h6>
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
                                    <h6 class="text-muted font-semibold">Sale</h6>
                                    <h6 class="font-extrabold mb-0">{{auth('salesman')->user()->orders->sum('total')}}
                                    </h6>
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
                                    <h6 class="text-muted font-semibold">Today Sale</h6>
                                    <h6 class="font-extrabold mb-0">
                                        {{auth('salesman')->user()->orders->where('created_at',\Carbon\Carbon::today())->sum('total')}}
                                    </h6>
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
                            <h4>Recent Orders</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Shop</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse (auth('salesman')->user()->orders->take(5) as $order)
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img
                                                            src="{{asset('assets/images/faces')}}/{{$order->customer->avatar}}">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">{{$order->customer->username}}</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                {{\Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY')}}
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">{{$order->total}}</p>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="{{asset('assets/images/faces/5.jpg')}}">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Si Cantik</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class=" mb-0">Congratulations on your graduation!</p>
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
                            <img src="{{asset('assets/images/faces/1.jpg')}}" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold" style="font-size:15px;">{{ auth('salesman')->user()->name }}</h5>
                            <h6 class="text-muted mb-0" style="font-size: 11px;">{{ auth('salesman')->user()->mobile }}
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Customer Visited</h4>
                </div>
                <div class="card-content pb-4">
                    @forelse (auth('salesman')->user()->visits->where('created_at',\Carbon\Carbon::today()) as $visit)
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{asset('assets/images/faces')}}/{{$visit->customer->avatar}}">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">{{$visit->customer->username}}</h5>
                            <h6 class="text-muted mb-0">{{$visit->customer->mobile}}</h6>
                        </div>
                    </div>
                    @empty
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="{{asset('assets/images/bg/4853433.png')}}" width="200">
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">

                <div class="card-content">
                    <div class="card-body">
                        <div id="map" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKE74qyuQZ0ctAAZoEsLGjGQGf6XcE3PU&libraries=geometry"></script>
<script>
    function initMap() {
        // Define the map options
        var options = {
            zoom: 6,
            center: { lat: 30.3753, lng: 69.3451 }, // Center coordinates of Pakistan
        };

        // Create the map instance
        var map = new google.maps.Map(document.getElementById('map'), options);

        // Define the polyline coordinates
        // Define the polyline coordinates
    var coordinates = [
            @foreach ($customers as $customer )
            @php
            $user=DB::table('customers')->where('id',$customer)->first();
            @endphp
            { lat: {{$user->lat}}, lng: {{$user->lng}} },

            @endforeach

        ];

        // Create the polyline instance
        var polyline = new google.maps.Polyline({
            path: coordinates,
            geodesic: true,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2,
        });

        // Set the polyline on the map
        polyline.setMap(map);

        // Add markers with location and user names
        var markers = [
            @foreach ($customers as $customer )
            @php
            $user=DB::table('customers')->where('id',$customer)->first();
            @endphp
            {  position: { lat: {{$user->lat}}, lng: {{$user->lng}} },
                name: "{{$user->username}}",
                mobile: "{{$user->mobile}}" },

            @endforeach
        ];
        markers.forEach(function (markerData) {
            var marker = new google.maps.Marker({
                position: markerData.position,
                map: map,
                title: markerData.name,
                icon: {
                    url: '{{ asset("assets/images/samples/shop.png") }}',
                    scaledSize: new google.maps.Size(24, 24),
                },
            });

            var infoWindow = new google.maps.InfoWindow({
                content: '<div><strong>' + markerData.name + '</strong></div>' +
                    '<div>Mobile: ' + markerData.mobile + '</div>'
            });

            marker.addListener('click', function () {
                infoWindow.open(map, marker);
            });
        });

        // Update the salesman's position on the map at regular intervals
        setInterval(function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var salesmanPosition = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    var salesmanMarker = new google.maps.Marker({
                        position: salesmanPosition,
                        map: map,
                        icon: {
                            url: '{{ asset("assets/images/faces/1.jpg") }}',
                            scaledSize: new google.maps.Size(16, 16),
                        },
                    });
                }, function (error) {
                    console.log('Error occurred while getting GPS position:', error);
                }, {
                    enableHighAccuracy: true, // Use GPS for higher accuracy
                    timeout: 10000, // Timeout after 5 seconds
                    maximumAge: 0 // Disable caching
                });
            }
        }, 60000); // Refresh every 1 minute (60000 milliseconds)
    }

    // Initialize the map when the page finishes loading
    window.onload = initMap;
</script>
@endpush
