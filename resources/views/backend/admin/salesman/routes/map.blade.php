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
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Route Pollyline Map</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.view_all_routes') }}">Routes</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Form Layout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{$route->name}} Route Map</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @php
    $customer=DB::table('route_customers')->where('route_id',$route->id)->first();
    $customers=explode(',',$customer->customer_id);
    @endphp
@endsection

@push('scripts')
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
                title: markerData.name
            });

            var infoWindow = new google.maps.InfoWindow({
                content: '<div><strong>' + markerData.name + '</strong></div>' +
                '<div>Mobile: ' + markerData.mobile + '</div>'
            });

            marker.addListener('click', function () {
                infoWindow.open(map, marker);
            });
        });
    }

    // Initialize the map when the page finishes loading
    window.onload = initMap;
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDH3sy54TYQgdd2y-xCIjT41rmw2DOP2hg&callback=initMap"></script>

@endpush
