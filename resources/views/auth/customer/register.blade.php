@extends('layout.login')
@section('content')
    <div class="row h-100">
        <div class="col-lg-6 col-12">
            <div id="auth-left">
                <div >
                    <a href="customer/login"><img src="{{ asset('assets/images/logo/Sales.png') }}" width="150" alt="Logo"></a>
                </div>
                <h5 class="title">Customer Sign Up</h5>
                <p class="mb-1">Input your data to register on our website.</p>

                <form id="registrationForm" action="{{ route('customer.register.submit') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-2">
                        <input type="text" class="form-control form-control-xl" placeholder="Username" name="username">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-2">
                        <input type="text" class="form-control form-control-xl"
                            placeholder="Shop name like aryan-kryana-store" name="shopname">
                        <div class="form-control-icon">
                            <i class="bi bi-shop"></i>
                        </div>
                        @error('shopname')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-2">
                        <input type="email" class="form-control form-control-xl" placeholder="Email address"
                            name="email">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-2">
                        <input type="text" class="form-control form-control-xl" placeholder="Mobile" name="mobile">
                        <div class="form-control-icon">
                            <i class="bi bi-phone"></i>
                        </div>
                        @error('mobile')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-2">
                        <input type="password" class="form-control form-control-xl" name="password">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group position-relative has-icon-left mb-2">
                        <input type="file" class="form-control form-control-xl" name="avatar">
                        <div class="form-control-icon">
                            <i class="bi bi-image"></i>
                        </div>
                        @error('avatar')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lng" id="lng">
                    <input type="hidden" name="address" id="address">
                    <input type="hidden" name="city" id="city">
                    <button id="submitButton" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit"
                        disabled>Sign Up</button>
                </form>

                <div class="text-center mt-2 text-lg fs-4">
                    <p class='text-gray-600'>Already have an account? <a href="customer/login" class="font-bold">Log in</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-6 justify-content-center d-lg-block">
            <img src="{{asset('assets/images/logo/Sales.png')}}" class="img-thumbnail" width="1000" alt="">
        </div>
    </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       // console.log('Hello aslam');
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
        } else {
            console.log('Geolocation is not supported by this browser.');
        }

        function successCallback(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;

            // Store the latitude and longitude values in the hidden form fields
            $('#lat').val(latitude);
            $('#lng').val(longitude);

            // Retrieve the address and city name using reverse geocoding
            var geocodingUrl = 'https://nominatim.openstreetmap.org/reverse?lat=' + latitude + '&lon=' + longitude +
                '&format=json';

            $.ajax({
                url: geocodingUrl,
                method: 'GET',
                success: function(response) {
                    var address = response.display_name;
                    var city = response.city;

                    // Store the address and city values in the hidden form fields
                    $('#address').val(address);
                    $('#city').val(city);

                    // Enable the submit button after successfully retrieving the location information
                    enableSubmitButton();
                },
                error: function(error) {
                    console.log('Error occurred while retrieving address: ' + error.message);
                }
            });
        }

        function errorCallback(error) {
            console.log('Error occurred while retrieving location: ' + error.message);
        }

        // Function to enable the submit button
        function enableSubmitButton() {
            $('#submitButton').prop('disabled', false);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDH3sy54TYQgdd2y-xCIjT41rmw2DOP2hg&libraries=geometry"></script>
@endsection
