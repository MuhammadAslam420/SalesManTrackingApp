@push('styles')
<style>
    #map {
        height: 400px;
    }
</style>
@endpush
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-5 order-md-1 order-last">
                <h3>Salesman {{auth('salesman')->user()->name}} Today Route </h3>
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
                        <li class="breadcrumb-item"><a href="{{ route('salesman.shop') }}">Shop</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('salesman.dashboard') }}">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-7">
                        Today Route
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($route)
                <div id="map"></div>
                @else
                <div>
                    <img src="{{asset('assets/images/bg/4853433.png')}}" alt="">
                </div>
                @endif
            </div>
        </div>
    </section>
    @if($route)
    @php
    $customer=DB::table('route_customers')->where('route_id',$route->id)->first();
    $customers=explode(',',$customer->customer_id);
    @endphp
    @endif
</div>
@if($route)
@push('scripts')
<script>
    function initMap() {
        // Define the map options
        var options = {
            zoom: 11,
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
                mobile: "{{$user->mobile}}",
                lat: "{{$user->lat}}",
                lng: "{{$user->lng}}" },

            @endforeach
        ];

        markers.forEach(function (markerData) {
            var marker = new google.maps.Marker({
                position: markerData.position,
                map: map,
                title: markerData.name
            });

            var infoWindow = new google.maps.InfoWindow({
                content: '<div><i class="bi bi-person text-primary m-1"></i><strong>' + markerData.name + '</strong></div>' +
                '<div><i class="bi bi-phone text-primary m-1"></i> ' + markerData.mobile + '</div>' +
                '<div><i class="bi bi-map text-primary m-1"></i>' + markerData.lat + '</div>'  +
                '<div><i class="bi bi-map text-primary m-1"></i>' + markerData.lng + '</div>'
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
@endif
