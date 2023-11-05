@extends('layout.base')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Update Pay</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.salesmen') }}">Salesmen</a></li>
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
                            <h4 class="card-title">Pay Form</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="post" action="{{route('admin.update_salesman_pay',['salesmanId'=>$salesmanId])}}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="name">Basic Pay</label>
                                                <input type="text" id="basic" class="form-control"
                                                    placeholder="000.00" name="basic" value="{{isset($pay) ? $pay->basic : ''}}">
                                                @error('basic')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="medical">Medical Allowance </label>
                                                <input type="text" name="medical" id="medical" value="{{isset($pay) ? $pay->medical : ''}}" class="form-control" placeholder="0.0">
                                                @error('medical')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="transport">Transport Allowance </label>
                                                <input type="text" name="transport" id="transport" value="{{isset($pay) ? $pay->transport : ''}}" class="form-control" placeholder="0.0">
                                                @error('transport')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="annual_bonus">Annual Bonus </label>
                                                <input type="text" name="annual_bonus" id="annual_bonus" value="{{isset($pay) ? $pay->annual_bonus : ''}}" class="form-control" placeholder="0.0">
                                                @error('annual_bonus')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="annual_increment">Annual Increment (%) </label>
                                                <input type="text" name="annual_increment" id="annual_increment" value="{{isset($pay) ? $pay->annual_increment : ''}}" class="form-control" placeholder="0.0">
                                                @error('annual_increment')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="commission_on_sales">Commission On Sales (%) </label>
                                                <input type="text" name="commission_on_sales" id="commission_on_sales" value="{{isset($pay) ? $pay->commission_on_sales : ''}}" class="form-control" placeholder="0.0">
                                                @error('commission_on_sales')
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
