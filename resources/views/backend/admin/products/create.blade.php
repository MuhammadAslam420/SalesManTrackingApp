@extends('layout.base')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add Product</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.products') }}">Products</a></li>
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
                        <h4 class="card-title">Product Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.store_product') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <!-- name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">Product Name</label>
                                            <input type="text" class="form-control" id="name" name="name">
                                            @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Select Status</option>
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                            @error('status')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Stock and Quantity -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="stockIn">Stock In</label>
                                            <input type="text" class="form-control" id="stockIn" name="stockIn">
                                            @error('stockIn')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="qty">Quantity</label>
                                            <input type="text" class="form-control" id="qty" name="qty">
                                            @error('qty')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Product Image</label>
                                            <input type="file" class="form-control" name="image" id="selectImage">
                                            <a href="{{ asset('assets/images/products') }}/{{ isset($product) ? $product->image : '#' }}">
                                                <img id="preview"
                                                    src="{{ asset('assets/images/products') }}/{{ isset($product) ? $product->image : '#' }}"
                                                    alt="Selected Image" class="mt-3 img-thumbnail" width="120">
                                            </a>
                                            @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- SKU -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="SKU">SKU</label>
                                            <input type="text" class="form-control" id="SKU" name="SKU">
                                            @error('SKU')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Purchase and Sale Cost -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="purchase_cost">Purchase Cost</label>
                                            <input type="text" class="form-control" id="purchase_cost" name="purchase_cost">
                                            @error('purchase_cost')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sale_cost">Sale Cost</label>
                                            <input type="text" class="form-control" id="sale_cost" name="sale_cost">
                                            @error('sale_cost')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Discount Percentage -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discount_percentage">Discount Percentage</label>
                                            <input type="text" class="form-control" id="discount_percentage" name="discount_percentage">
                                            @error('discount_percentage')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Discount Quantity -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discount_on_qty">Discount Quantity</label>
                                            <input type="text" class="form-control" id="discount_on_qty" name="discount_on_qty">
                                            @error('discount_on_qty')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Discount Date -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discount_date_start">Discount Start Date</label>
                                            <input type="date" class="form-control" id="discount_date_start" name="discount_date_start">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="discount_date_end">Discount End Date</label>
                                            <input type="date" class="form-control" id="discount_date_end" name="discount_date_end">
                                        </div>
                                    </div>

                                    <!-- Sub Category -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label >Sub Category</label>
                                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                                                <option value="">Select SubCategory</option>
                                                @foreach ($subcategories as $subCategory)
                                                <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('sub_category_id')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea class="form-control" id="description" name="description"></textarea>
                                            @error('description')
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
<script src="//cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'description' );
</script>
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

