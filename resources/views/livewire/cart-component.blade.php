<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-5 order-md-1 order-last">
                <h3>Salesman {{auth('salesman')->user()->name}} Orders</h3>
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
                        @livewire('cart-count-component')
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
                    <div class="col-md-6">
                        Available Cart Items ({{Cart::instance('cart')->content()->count()}})
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderd">
                        <thead>
                            <tr>
                                <th style="font-size: :13px;font-weight:800;">ID</th>
                                <th style="font-size: :13px;font-weight:800;">ItemName</th>
                                <th style="font-size: :13px;font-weight:800;">Quantity</th>
                                <th style="font-size: :13px;font-weight:800;">Price</th>
                                <th style="font-size: :13px;font-weight:800;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @forelse (Cart::instance('cart')->content() as $item )
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    <span>
                                        <div class="avatar avatar-xl">
                                            <img src="{{asset('assets/images/products')}}/{{$item->model->image}}" alt="">
                                        </div>
                                        {{$item->name}}
                                    </span>
                                </td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->price}}</td>
                                <td><a href="#" class="btn btn-danger" wire:click.prevent="destroy('{{$item->rowId}}')"><i class="bi bi-trash"></i></a></td>
                            </tr>

                            @empty
                            <tr>
                                <div>
                                    <img src="{{asset('assets/images/bg/4853433.png')}}" alt="">
                                </div>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <td>Subtotal</td>
                            <td>{{Cart::subtotal()}}</td>
                            <td>||</td>
                            <td>Total</td>
                            <td>{{Cart::total()}}</td>
                        </tfoot>
                    </table>
                </div>
                @if(Cart::instance('cart')->count() > 0)
                <div class="row  justify-content-end">
                    <a href="{{route('salesman.checkout')}}" class="btn btn-success">Checkout</a>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
