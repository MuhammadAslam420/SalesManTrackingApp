<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-5 order-md-1 order-last">
                <h3>All Orders</h3>
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.product_create_form') }}">Add Product</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12 flex ">
                        <ul class="nav nav-tabs nav-tabs-solid  bg-default" id="myHeader">
                            <li class="nav-item">
                                <a href="#" wire:click="$set('activeTab', null)"
                                    class="nav-link {{ $activeTab === null ? 'active' : '' }}">All ({{($orders->count())}})</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" wire:click="$set('activeTab', 'pending')"
                                    class="nav-link {{ $activeTab === 'pending' ? 'active' : '' }}">Pending ({{($orders->where('status','pending')->count())}})</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" wire:click="$set('activeTab', 'processing')"
                                    class="nav-link {{ $activeTab === 'processing' ? 'active' : '' }}">Process ({{($orders->where('status','processing')->count())}})</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" wire:click="$set('activeTab', 'completed')"
                                    class="nav-link {{ $activeTab === 'completed' ? 'active' : '' }}">Completed ({{($orders->where('status','completed')->count())}})</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" wire:click="$set('activeTab', 'cancelled')"
                                    class="nav-link {{ $activeTab === 'cancelled' ? 'active' : '' }}">Cancelled ({{($orders->where('status','cancelled')->count())}})</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" wire:click.prevent="exportOrder" class="nav-link">
                                    <i class="bi bi-clipboard-data"></i>Export Excel</a>
                            </li>
                            <li class="nav-item">
                                <a href="#" wire:click.prevent="exportOrderCsv" class="nav-link">
                                    <i class="bi bi-clipboard-data"></i>Export CSV</a>
                            </li>
                        </ul>


                    </div>
                    <hr class="m-3">
                    <div class="col-md-6">
                        <input type="search" name="search" id="search"
                            placeholder="Search order by ID, total, subtotal, status, date..."
                            class="form-control float-right" wire:model="search">
                    </div>
                    <div class="col-md-3">
                        <select name="perPage" id="perPage" class="form-control" wire:model="perPage">
                            <option value="10">10</option>
                            <option value="16">16</option>
                            <option value="24">24</option>
                            <option value="32">32</option>
                            <option value="48">48</option>
                        </select>
                    </div>
                    <div class="col-md-3">
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
                                <th class="text-black-500 font-bold" width="30px">ID</th>
                                <th class="text-black-500 font-bold">Order</th>
                                <th class="text-black-500 font-bold">Shop</th>
                                <th class="text-black-500 font-bold">Salesman</th>
                                <th class="text-black-500 font-bold">SubTotal</th>
                                <th class="text-black-500 font-bold">Tax</th>
                                <th class="text-black-500 font-bold">Total</th>
                                <th class="text-black-500 font-bold">Discount</th>
                                <th class="text-black-500 font-bold">OrderStatus</th>
                                <th class="text-black-500 font-bold">UpdateStatus</th>
                                <th class="text-black-500 font-bold">DeliveryDate</th>
                                <th class="text-black-500 font-bold">OrderDate</th>
                                <th class="text-black-500 font-bold">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td class="text-[11px] font-bold">
                                        @foreach ($order->orderItems as $item)
                                            <div>
                                                <div class="avatar avatar-lg bg-danger me-3"><img
                                                        src="{{ asset('assets/images/products') }}/{{ $item->product->image }}"
                                                        width="120" alt=""></div>
                                                <p>Name:&nbsp;<span>{{ $item->product->name }}</span></p>
                                                <p>Qty:&nbsp;<span>{{ $item->qty }}</span></p>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="text-[11px] font-bold">{{ $order->customer->shopname }}</td>
                                    <td class="text-[11px] font-bold">
                                        <div>
                                            <p><span>{{ $order->salesman->name }}</span></p>
                                            <p>Commission: <span>{{ $order->salesman_commission }}</span></p>
                                        </div>
                                    </td>
                                    <td class="text-[11px] font-bold">{{ $order->subtotal }}</td>
                                    <td class="text-[11px] font-bold">{{ $order->tax }}</td>
                                    <td class="text-[11px] font-bold">{{ $order->total }}</td>
                                    <td class="text-[11px] font-bold">{{ $order->discount }}</td>
                                    <td class="text-[11px] font-bold">
                                        <a href="#">
                                            <span class="badge bg-success" style="text-transform: capitalize;">
                                                {{ $order->status }}
                                            </span>
                                        </a>
                                    </td>
                                    <td>
                                        <div class="relative" x-data="{ isOpen: false }">
                                            <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
                                                class="flex items-center btn btn-default text-blue-500 hover:text-green-900 font-extrabold">
                                                {{ $order->status }}
                                            </button>
                                            <ul x-show="isOpen" style="padding:5px;margin:5px;"
                                                @click.away="isOpen = false">
                                                <li>
                                                    <a href="#"
                                                        wire:click.prevent="updateStatus('{{ $order->id }}','processing')">
                                                        <span class="ml-2">Process</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        wire:click.prevent="updateStatus('{{ $order->id }}','completed')">
                                                        <span class="ml-2">Completed</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#"
                                                        wire:click.prevent="updateStatus('{{ $order->id }}','cancelled')">
                                                        <span class="ml-2">Cancelled</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="text-[11px] font-bold">
                                        {{ \Carbon\Carbon::parse($order->delivery_date)->isoFormat('MMM Do YYYY') }}
                                    </td>

                                    <td class="text-[11px] font-bold">
                                        {{ \Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY') }}
                                    </td>
                                    <td class="text-[11px] font-bold"> <a href="{{route('admin.order_detail',['orderId'=>$order->id])}}" class="badge bg-primary"><i
                                                class="bi bi-pencil"></i></a></td>

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
