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
                        <h5 class="card-title">Folders</h5>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <!-- Display folder icons and names -->
                            @foreach ($folders as $folder)
                                <a href="{{ route('folders.show',['folder'=>$folder['name']] ) }}">
                                    <img src="{{ asset('assets/folder-icon.png') }}" width="120" alt="Folder Icon">
                                    <span style="text-transform: capitalize;">{{ $folder['name'] }}</span>
                                </a>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
