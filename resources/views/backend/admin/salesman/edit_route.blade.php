@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Update Route</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
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
                            <h4 class="card-title">Route Form</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="post" action="{{ route('admin.update_salesman_route',['routeId'=>$route->id]) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name">Route Name</label>
                                                <input type="text" id="name" class="form-control"
                                                    placeholder="Full Name" name="name"
                                                    value="{{ isset($route) ? $route->name : '' }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="salesman_id">Assign Salesman To Route</label>
                                                <select name="salesman_id" id="salesman_id" class="form-control">
                                                    <option value="" disabled>Select Salesman</option>
                                                    @foreach ($salesmen as $salesman)
                                                        <option value="{{ $salesman->id }}" @if(isset($route) && $route->salesman_id == $salesman->id) selected @endif>{{ $salesman->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('salesman_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="default" disabled>Select Status</option>
                                                    <option value="active" @if(isset($route) && $route->status == 'active') selected @endif>Active</option>
                                                    <option value="inactive" @if(isset($route) && $route->status == 'inactive') selected @endif>In-Active</option>
                                                    <option value="deleted" @if(isset($route) && $route->status == 'deleted') selected @endif>Deleted</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="visit_day">Visit Day</label>
                                                <select name="visit_day" id="visit_day" class="form-control">
                                                    <option value="default" disabled>Select visit day</option>
                                                    <option value="monday" @if(isset($route) && $route->visit_day == 'monday') selected @endif>Monday</option>
                                                    <option value="tuesday" @if(isset($route) && $route->visit_day == 'tuesday') selected @endif>Tuesday</option>
                                                    <option value="wednesday" @if(isset($route) && $route->visit_day == 'wednesday') selected @endif>Wednesday</option>
                                                    <option value="thursday" @if(isset($route) && $route->visit_day == 'thursday') selected @endif>Thursday</option>
                                                    <option value="friday" @if(isset($route) && $route->visit_day == 'friday') selected @endif>Friday</option>
                                                    <option value="saturday" @if(isset($route) && $route->visit_day == 'saturday') selected @endif>Saturday</option>
                                                    <option value="sunday" @if(isset($route) && $route->visit_day == 'sunday') selected @endif>Sunday</option>

                                                </select>
                                                @error('visit_day')
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
@endsection
