@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-5 order-md-1 order-last">
                    <h3>File Manager</h3>
                </div>
                <div class="col-12 col-md-7 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#">Manages File</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">{{ $folder }}</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Display folder icons and names -->
                            <div class="row">
                            @foreach ($images as $image)
                                <div class="col-md-2">
                                    <img src="{{ asset('/' . $image) }}"  alt="{{ basename($image) }}" class="img-thumbnail" style="width: 120px; height:120px; margin:0 5px;">
                                <span>{{basename($image)}}</span>
                                </div>
                            @endforeach

                        </div>
                        <br>
                            <!-- Upload new image form -->
                            <form method="POST" action="{{ route('folders.upload', ['folder' => $folder]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="images" class="form-label">Upload Images <b class="text-danger">(Type)jpg,png,jpeg,gif</b></label>
                                    <input type="file" class="form-control" multiple="multiple" id="images" name="images[]" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
