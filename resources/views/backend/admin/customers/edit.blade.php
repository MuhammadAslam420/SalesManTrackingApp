@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Update Customer</h3>
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
                            <h4 class="card-title">Customer Form</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.customer_Update',['id'=>$customer->id]) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $customer->id ?? '' }}">
                                        <!-- Username -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="username"
                                                    value="{{ old('username', ($customer->username) ?? '') }}" required>
                                            </div>
                                        </div>

                                        <!-- Shop Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="shopname">Shop Name</label>
                                                <input type="text" class="form-control" id="shopname" name="shopname"
                                                    value="{{ old('shopname', $customer->shopname ?? '') }}" required>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ old('email', $customer->email ?? '') }}" required>
                                            </div>
                                        </div>

                                        <!-- Mobile -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile"
                                                    value="{{ old('mobile', $customer->mobile ?? '') }}" required>
                                            </div>
                                        </div>

                                        <!-- City -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" class="form-control" id="city" name="city"
                                                    value="{{ old('city', $customer->city ?? '') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="city">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">Select Status</option>
                                                    <option value="active" {{ isset($customer) && $customer->status == 'active' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="inactive"
                                                        {{ isset($customer) && $customer->status == 'inactive' ? 'selected' : '' }}>InActive</option>
                                                    <option value="block" {{ isset($customer) && $customer->status == 'block' ? 'selected' : '' }}>
                                                        Block</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Address -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea id="address" class="form-control" name="address" required>{{ old('address', $customer->address ?? '') }}</textarea>
                                            </div>
                                        </div>

                                        <!-- Avatar -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="avatar">Profile Image</label>
                                                <input type="file" class="form-control" name="avatar" id="selectImage">
                                                <a href="{{ asset('assets/images/faces') }}/{{ isset($customer) ? $customer->avatar : '#' }}">
                                                    <img id="preview"
                                                        src="{{ asset('assets/images/faces') }}/{{ isset($customer) ? $customer->avatar : '#' }}"
                                                        alt="Selected Image" class="mt-3 img-thumbnail" width="120">
                                                </a>
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
