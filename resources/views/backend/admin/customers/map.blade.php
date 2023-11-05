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
                    <h3>{{ $customer->username }} Location On Map</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.view_all_customers') }}">Customers</a></li>
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
                            <h4 class="card-title">{{ $customer->username }} Location on Map</h4>
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
@endsection
    @push('scripts')
    <script>
        // Initialize Google Map when the page is loaded
        window.addEventListener('load', function() {
            initMap();
        });
    </script>
        <script>
            function initMap() {
                var userLocation = {
                    lat: {{ $customer->lat }},
                    lng: {{ $customer->lng }}
                };
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: userLocation,
                    zoom: 12
                });

                var marker = new google.maps.Marker({
                    position: userLocation,
                    map: map
                });

                var infoWindow = new google.maps.InfoWindow({
                    content: '<h3>{{ $customer->username }}</h3>' +
                        '<h5>{{ $customer->shopname }}</h5>' +
                        '<p>Address: {{ $customer->address }}</p>' +
                        '<p>Mobile: {{ $customer->mobile }}</p>'
                });

                marker.addListener('click', function() {
                    infoWindow.open(map, marker);
                });
            }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDH3sy54TYQgdd2y-xCIjT41rmw2DOP2hg&callback=initMap"> </script>

    @endpush
