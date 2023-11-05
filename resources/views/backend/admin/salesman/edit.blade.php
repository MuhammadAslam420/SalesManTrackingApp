@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Edit Salesman</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.salesmen') }}">Salesmen</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Salesman</li>
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
                            <h4 class="card-title">Salesman Form</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="post" action="{{ route('admin.salesman.update', $salesman->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name">Salesman Name</label>
                                                <input type="text" id="name" class="form-control"
                                                    placeholder="Full Name" value="{{ isset($salesman) ? $salesman->name : '' }}" name="name">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name">Salesman UserName</label>
                                                <input type="text" id="username" class="form-control"
                                                    placeholder="name-employee-no" value="{{ isset($salesman) ? $salesman->username : '' }}" name="username">
                                                @error('username')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="employee_no">Employee No</label>
                                                <input type="text" id="employee_no" class="form-control"
                                                    placeholder="Employee No" name="employee_no" value="{{ isset($salesman) ? $salesman->employee_no : '' }}">
                                                @error('employee_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Email Address" value="{{ isset($salesman) ? $salesman->email : '' }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="text" id="mobile" class="form-control" name="mobile"
                                                    placeholder="Mobile No" value="{{ isset($salesman) ? $salesman->mobile : '' }}">
                                                @error('mobile')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <input type="text" id="city" class="form-control" name="city"
                                                    placeholder="City" value="{{ isset($salesman) ? $salesman->city : '' }}">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" id="address" class="form-control" name="address"
                                                    placeholder="Address" value="{{ isset($salesman) ? $salesman->address : '' }}">
                                                @error('address')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="default" disabled>Select Status</option>
                                                    <option value="active" {{ isset($salesman) && $salesman->status == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ isset($salesman) && $salesman->status == 'inactive' ? 'selected' : '' }}>In-Active</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="avatar">Profile Image</label>
                                                <input type="file" class="form-control" name="avatar"
                                                    id="selectImage">
                                            </div>
                                            <a href="{{asset('assets/images/faces')}}/{{ isset($salesman) ? asset($salesman->avatar) : '#' }}">
                                            <img id="preview" src="{{asset('assets/images/faces')}}/{{ isset($salesman) ? ($salesman->avatar) : '#' }}" alt="Selected Image" class="mt-3 img-thumbnail" width="120" /></a>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Update</button>
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
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files;
            if (file) {
                preview.src = URL.createObjectURL(file);
            }
        };
    </script>
@endpush
