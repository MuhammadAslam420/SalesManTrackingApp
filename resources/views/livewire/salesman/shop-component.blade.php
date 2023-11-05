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
                        Available Products
                    </div>
                    <div class="col-md-3">
                        <input type="search" name="search" id="search"
                            placeholder="Search product here..." class="form-control float-right"
                            wire:model="search">
                    </div>
                    <div class="col-md-1">
                        <input type="number" name="cost" id="cost" class="form-control" wire:model="cost">
                    </div>
                    <div class="col-md-1">
                        <select name="perPage" id="perPage" class="form-control" wire:model="perPage">
                            <option value="10">10</option>
                            <option value="16">16</option>
                            <option value="24">24</option>
                            <option value="32">32</option>
                            <option value="48">48</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <select name="sorting" id="sorting" class="form-control" wire:model="sorting">
                            <option value="asc">ASC</option>
                            <option value="desc">DESC</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    @foreach ($products as $product )
                    <div class="col-md-3">
                        <div class="card">
                          <img src="{{asset('assets/images/products')}}/{{$product->image}}" class="card-img-top" alt="Product Image">
                          <div class="card-body">
                            <h5 class="card-title">{{$product->name}}</h5>
                            <p class="card-text">Price: {{$product->sale_cost}}</p>
                            @if(\Carbon\Carbon::today()->between($product->discount_date_start, $product->discount_end_date))
                            <p class="card-text">{{$product->discount_percentage}}% OFF on: {{$product->discount_on_qty}} items</p>
                            @endif
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" wire:model="qty.{{$product->id}}" min="1" max="500" value="1" wire:model="qty">
                            </div>
                          </div>
                          <div class="card-footer">
                            <button class="btn btn-primary btn-block" wire:click.prevent="store('{{$product->id}}','{{$product->name}}',{{$product->sale_cost}})">Add to Cart</button>
                          </div>
                        </div>
                      </div>
                    @endforeach
                </div>
                <div class="pagination">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </section>
</div>
