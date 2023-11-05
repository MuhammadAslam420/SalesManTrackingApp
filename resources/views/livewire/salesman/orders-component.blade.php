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
                    <div class="col-md-7">
                        All Orders Table
                    </div>
                    <div class="col-md-3">
                        <input type="search" name="search" id="search"
                            placeholder="ID, name, SKU, status, date search here..." class="form-control float-right"
                            wire:model="search">
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
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="font-size:11px;font-weight:900;color:black;" width="30px">ID</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Customer & Items</th>
                                <th style="font-size:11px;font-weight:900;color:black;">D.Date</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Total</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Tax</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Status</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Order.Date</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Commission</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td class="text-[10px] font-extrabold">
                                        <div>
                                        <p>Shop: <span>{{$order->customer->shopname}}</span></p>
                                        <p>Address: <span>{{$order->customer->address}}</span></p>
                                        </div>
                                        @foreach ($order->orderItems as $item)
                                        <div class="avatar avatar-xl">
                                            <img src="{{asset('assets/images/products')}}/{{$item->product->image}}" alt="">
                                        </div>
                                        <p><span>{{$item->product->name}}</span></p>
                                        <p>Items: <span>{{$item->qty}}</span></p>
                                        <p>Price: <span>{{$item->price}}</span></p>
                                        <br>

                                        @endforeach
                                    </td>
                                    <td class="text-[10px] font-extrabold text-orange-700">{{\Carbon\Carbon::parse($order->delivery_date)->isoFormat('MMM Do YYYY')}}</td>
                                    <td class="text-[10px] font-extrabold text-red-500">{{$order->total}}</td>
                                    <td class="text-[10px] font-extrabold text-red-800">{{$order->tax}}</td>
                                    <td style="font-size:12px;font-weight:900;">
                                        @if ($order->status === 'active')
                                            <a href="#"
                                                wire:click="updateStatus('{{ $order->id }}', 'inactive')">
                                                <span class="badge bg-success" style="text-transform: capitalize;">
                                                    {{ $order->status }}
                                                </span>
                                            </a>
                                        @else
                                            <a href="#"
                                                wire:click="updateStatus('{{ $order->id }}', 'active')">
                                                <span class="badge bg-danger" style="text-transform: capitalize;">
                                                    {{ $order->status }}
                                                </span>
                                            </a>
                                        @endif

                                    </td>
                                    <td style="font-size:12px;font-weight:900;">
                                        {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY') }}
                                    </td>
                                    <td class="text-[10px] font-extrabold text-purple-700">{{$order->salesman_commission}}</td>

                                </tr>
                            @empty
                                <tr>
                                    <div class="row">
                                        <img src="{{ asset('assets/images/bg/4853433.png') }}" alt="no-record">
                                    </div>
                                </tr>
                            @endforelse


                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
