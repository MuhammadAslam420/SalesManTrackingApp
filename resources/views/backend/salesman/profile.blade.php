@extends('layout.salesman')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-5 order-md-1 order-last">
                <h3>Salesman {{auth('salesman')->user()->name}}</h3>
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
                        <li class="breadcrumb-item"><a href="{{ route('salesman.shop') }}">Shop</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('salesman.dashboard') }}">Dashboard</a></li>
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
                            <img src="{{asset('assets/images/faces')}}/{{auth('salesman')->user()->avatar}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Salesman</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->name}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Email</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->email}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Mobile</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->mobile}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">City</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->city}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Address</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->address}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Latitude</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->lat}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Landitude</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->lng}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Status</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->status}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Online</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->online}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Created By</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->createdBy->name}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Basic Pay</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->pay->basic}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Medical Allowance</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->pay->medical}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Transport</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->pay->transport}}</td>
                        </tr>
                        <tr>
                            <td class="text-[11px] font-bold hover:text-red-800">Commission %</td>
                            <td class="text-[10px] font-extrabold hover:text-purple-900">{{auth('salesman')->user()->pay->commission_on_sales}} %</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
