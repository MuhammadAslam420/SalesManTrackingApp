@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ isset($admin) ? 'Edit Admin' : 'Add Admin' }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.administration') }}">Admins</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ isset($admin) ? 'Edit' : 'Create' }}</li>
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
                            <h4 class="card-title">{{ isset($admin) ? 'Edit Admin' : 'Add Admin' }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form method="post" action="{{ isset($admin) ? route('admin.update_admin',['adminId'=>$admin->id]) : route('admin.store_admin') }}" enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($admin))
                                        @method('PUT')
                                    @endif
                                    <div class="row">
                                        <!-- name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Admin Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($admin) ? $admin->name : old('name') }}">
                                                @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ isset($admin) ? $admin->email : old('email') }}">
                                                @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" value="{{ isset($admin) ? $admin->mobile : old('mobile') }}">
                                                @error('mobile')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">Select Status</option>
                                                    <option value="active" {{ (isset($admin) && $admin->status == 'active') || old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                                    <option value="inactive" {{ (isset($admin) && $admin->status == 'inactive') || old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                </select>
                                                @error('status')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- avatar -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="avatar">Avatar / Image</label>
                                                <input type="file" class="form-control" name="avatar" id="selectImage">
                                                @if(isset($admin) && $admin->avatar)
                                                    <a href="{{ asset('assets/images/faces') }}/{{ $admin->avatar }}">
                                                        <img id="preview" src="{{ asset('assets/images/faces') }}/{{ $admin->avatar }}" alt="Selected Image" class="mt-3 img-thumbnail" width="120">
                                                    </a>
                                                @else
                                                    <img id="preview" src="#" alt="Selected Image" class="mt-3 img-thumbnail" width="120" style="display: none;">
                                                @endif
                                                @error('avatar')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">{{ isset($admin) ? 'Update' : 'Save' }}</button>
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
