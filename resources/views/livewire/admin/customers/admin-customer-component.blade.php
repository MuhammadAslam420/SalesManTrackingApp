<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    Customers Table
                </div>
                <div class="col-md-4">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible show fade">
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible show fade">
                            {{ Session::get('error') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                </div>
                <div class="col-md-3">
                    <input type="search" name="search" id="search" placeholder="search here..."
                        class="form-control float-right" wire:model="search">
                </div>
                <div class="col-md-1">
                    <select name="perPage" id="perPage" class="form-control" wire:model="perPage">
                        <option value="5">5</option>
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
                            <th style="font-size:11px;font-weight:700;" width="30px">ID</th>
                            <th style="font-size:11px;font-weight:700;">Name</th>
                            <th style="font-size:11px;font-weight:700;">ShopName</th>
                            <th style="font-size:11px;font-weight:700;">City</th>
                            <th style="font-size:11px;font-weight:700;">Address</th>
                            <th style="font-size:11px;font-weight:700;">Status</th>
                            <th style="font-size:11px;font-weight:700;">Mobile</th>
                            <th style="font-size:11px;font-weight:700;">Email</th>
                            <th style="font-size:11px;font-weight:700;">CreatedBy</th>
                            <th style="font-size:11px;font-weight:700;">Date</th>
                            <th style="font-size:11px;font-weight:700;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $customer->username }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $customer->shopname }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $customer->city }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $customer->address }}</td>
                                <td style="font-size:12px;font-weight:900;">
                                    @if ($customer->status === 'active')
                                        <span class="badge bg-success" style="text-transform: capitalize">
                                            <a href="#" class="text-light"
                                                wire:click.prevent="updateStatus('{{ $customer->id }}','inactive')">{{ $customer->status }}</a>
                                        </span>
                                    @elseif($customer->status ==='inactive')
                                        <span class="badge bg-warning" style="text-transform: capitalize">
                                            <a href="#" class="text-light"
                                                wire:click.prevent="updateStatus('{{ $customer->id }}','active')">{{ $customer->status }}</a>
                                        </span>
                                    @else
                                    <span class="badge bg-danger" style="text-transform: capitalize">
                                        <a href="#" class="text-light"
                                            wire:click.prevent="updateStatus('{{ $customer->id }}','active')">{{ $customer->status }}</a>
                                    </span>
                                    @endif
                                </td>
                                <td style="font-size:12px;font-weight:900;">{{ $customer->mobile }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $customer->email }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $customer->createdBy->name }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ \Carbon\Carbon::parse($customer->created_at)->isoFormat('MMM Do YYYY') }}</td>
                                @if ($customer->shopname != null)
                                    <td style="font-size:12px;font-weight:900;">
                                        <div class="relative" x-data="{ isOpen: false }">
                                            <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
                                                class="flex items-center btn btn-default "
                                                style="font-size:12px;font-weight:900;">
                                                Links
                                            </button>
                                            <ul x-show="isOpen" style="padding:5px;margin:5px;"
                                                @click.away="isOpen = false">
                                                <li><a href="{{route('admin.view_customer_profile',['id'=>$customer->id])}}">Profile</a></li>
                                                <li><a href="{{route('admin.view_customer_balance_sheet',['id'=>$customer->id])}}">Balance</a></li>
                                                <li><a href="{{route('admin.customer_orders',['id'=>$customer->id])}}">Orders</a></li>
                                                <li><a href="{{route('admin.customer_transactions',['id'=>$customer->id])}}">Transactions</a></li>
                                                <li><a href="{{route('admin.customer_map',['id'=>$customer->id])}}">Map</a></li>
                                                <li><a href="{{route('admin.edit_customer',['id'=>$customer->id])}}">Edit</a></li>
                                                <li><a href="#">Delete</a></li>

                                            </ul>
                                        </div>
                                    </td>
                                @endif

                            </tr>
                        @empty
                            <tr>
                                <div class="row">
                                    <img src="{{ asset('assets/images/bg/4853433.jpg') }}" alt="no-record">
                                </div>
                            </tr>
                        @endforelse


                    </tbody>
                </table>
                <div class="pagination">
                {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
