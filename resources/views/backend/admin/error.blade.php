@extends('layout.error')
@section('content')
<div class="error-page container">
    <div class="col-md-8 col-12 offset-md-2">
        <img class="img-error" src="{{asset('assets/images/samples/error-404.png')}}" alt="Not Found">
        <div class="text-center">
            <div class="error-message">
                <p>An error occurred: {{ $errorMessage }}</p>
            </div>
            <h1 class="error-title">NOT FOUND</h1>
            <p class='fs-5 text-gray-600'>The page you are looking not found.</p>
            <a href="{{route('admin.dashboard')}}" class="btn btn-lg btn-outline-primary mt-3">Go Home</a>
        </div>
    </div>
</div>

@endsection
