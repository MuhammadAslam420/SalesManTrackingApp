<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Salesman - Dashboard</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.9.0/tailwind.min.css"
        integrity="sha512-wOgO+8E/LgrYRSPtvpNg8fY7vjzlqdsVZ34wYdGtpj/OyVdiw5ustbFnMuCb75X9YdHHsV5vY3eQq3wCE4s5+g=="
        crossorigin="anonymous" />

    @livewireStyles
    @stack('styles')

</head>

<body>
    @include('notifications.notification')
    <div id="app">
        <x-salesman_sidebar />
        <div id="main">
            <x-header />

            @yield('content')


            <x-footer />

        </div>
    </div>
    <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Include Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKE74qyuQZ0ctAAZoEsLGjGQGf6XcE3PU&libraries=geometry"></script>
    <script>
    // Function to retrieve the location
        function getLocation() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
          } else {
            console.log('Geolocation is not supported by this browser.');
          }
        }

        // Function to handle the successful retrieval of location
        function successCallback(position) {
          var latitude = position.coords.latitude;
          var longitude = position.coords.longitude;

          // Store the latitude and longitude in the route_histories table
          var salesmanId = {{ Auth::guard('salesman')->user()->id }};
          var timestamp = Date.now();

          // Get the CSRF token
          var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

          // Make an AJAX request to store the location data
          $.ajax({
            url: '/salesman/store-location',
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': csrfToken
            },
            data: {
              salesman_id: salesmanId,
              lat: latitude,
              lng: longitude,
              timestamp: timestamp
            },
            success: function(response) {
              console.log('Location data stored successfully.');
            },
            error: function(error) {
              console.log('Error occurred while storing location data: ' + error.message);
            }
          });
        }

        // Function to handle error in retrieving location
        function errorCallback(error) {
          console.log('Error occurred while retrieving location: ' + error.message);
        }

        // Call getLocation() immediately to get the location
        getLocation();

        // Call getLocation() every minute (adjust the interval as needed)
        setInterval(getLocation, 60000); // 60000 milliseconds = 1 minute

    </script>

    @livewireScripts
    @stack('scripts')

</body>

</html>
