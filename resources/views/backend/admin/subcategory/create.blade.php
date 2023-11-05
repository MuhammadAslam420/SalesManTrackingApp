@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Add SubCategory</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.sub_categories') }}">SubCategories</a></li>
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
                            <h4 class="card-title">SubCategory Form</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form method="post" action="{{ route('admin.store_sub_category') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <!-- name -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="name">Name Category Name</label>
                                                <input type="text" class="form-control" id="name" name="name">
                                                @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="category_id">Select Parent Category</label>
                                                <select name="category_id" id="category_id" class="form-control">
                                                    <option value="" >Select Category</option>
                                                    @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">Select Status</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">InActive</option>
                                                </select>
                                                @error('status')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Logo -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="logo">Category Image</label>
                                                <input type="file" class="form-control" name="logo" id="selectImage">
                                                <a href="{{ asset('assets/images/category') }}/{{ isset($category) ? $category->logo : '#' }}">
                                                    <img id="preview"
                                                        src="{{ asset('assets/images/category') }}/{{ isset($category) ? $category->logo : '#' }}"
                                                        alt="Selected Image" class="mt-3 img-thumbnail" width="120">
                                                </a>
                                                @error('logo')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                            </form>
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
    document.addEventListener('DOMContentLoaded', () => {
        const selectImage = document.getElementById('selectImage');
        const preview = document.getElementById('preview');

        selectImage.onchange = evt => {
            preview.style.display = 'block';
            const [file] = selectImage.files;
            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        };
    });
</script>
@endpush
