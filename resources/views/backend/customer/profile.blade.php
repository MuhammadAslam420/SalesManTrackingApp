@extends('layout.customer')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-5 order-md-1 order-last">
                <h3>Customer {{auth('customer')->user()->username}}</h3>
            </div>
            <div class="col-12 col-md-7 order-md-2 order-first">
                @if (Session::has('success'))
                    <span class="alert alert-success alert-dismissible show fade" role="alert"
                        id="success-alert">{{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </span>
                @endif
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <div class="avatar avatar-xl">
                            <img src="{{asset('assets/images/faces')}}/{{auth('customer')->user()->avatar}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Shop</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('customer')->user()->shopname}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Email</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('customer')->user()->email}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Mobile</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('customer')->user()->mobile}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">City</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('customer')->user()->city}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Address</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('customer')->user()->address}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Latitude</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('customer')->user()->lat}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Landitude</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('customer')->user()->lng}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Status</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('customer')->user()->status}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Created By</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('customer')->user()->createdBy->name}}</td>
                        </tr>
                        <tfoot>
                            <tr class="">
                                <a href="{{route('customer.edit')}}" class="btn btn-primary float-right mb-2">Edit Profile</a>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
