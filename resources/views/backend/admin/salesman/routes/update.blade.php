@extends('layout.base')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-7 order-md-1 order-last">
                <h3>Update Customers</h3>
            </div>
            <div class="col-12 col-md-5 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.view_all_routes') }}">Routes</a></li>
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
                        <h4 class="card-title">Route Customers Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" method="post" action="{{route('admin.update_customers_to_route',['routeId'=>$route->route_id])}}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="name">Pick Customers</label>
                                            <select name="customer_Ids[]" id="customer_Ids" multiple="multiple" class="form-control">
                                                @foreach ($customers as $customer )
                                                <option value="{{$customer->id}}" @if(in_array($customer->id, $attachedCustomers)) selected @endif >{{$customer->shopname}}</option>
                                                @endforeach
                                            </select>
                                            @error('customer_Ids')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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
@push('scripts')
<script>
    // Initialize Select2
    $(document).ready(function() {
        $('#customer_Ids').select2();
    });
</script>
@endpush
@endsection


