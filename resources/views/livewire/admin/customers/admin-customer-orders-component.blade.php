<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-7">
                    Customers Orders Table
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
                            <th style="font-size:11px;font-weight:700;">Status</th>
                            <th style="font-size:11px;font-weight:700;">DeliveryDate</th>
                            <th style="font-size:11px;font-weight:700;">Total</th>
                            <th style="font-size:11px;font-weight:700;">SubTotal</th>
                            <th style="font-size:11px;font-weight:700;">Tax</th>
                            <th style="font-size:11px;font-weight:700;">Discount</th>
                            <th style="font-size:11px;font-weight:700;">Salesman</th>
                            <th style="font-size:11px;font-weight:700;">OrderDate</th>
                            <th style="font-size:11px;font-weight:700;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $order->status }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $order->delivery_date }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $order->total }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $order->tax }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $order->subtotal }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $order->discount }}</td>
                                <td style="font-size:12px;font-weight:900;">{{$order->salesman_id}}.{{ $order->salesman->name }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('MMM Do YYYY') }}</td>
                                <td style="font-size:12px;font-weight:900;">
                                    <a href="{{route('admin.customer_order_detail',['orderId'=>$order->id])}}" class="badge bg-inof"><i class="bi bi-gift"></i></a>
                                </td>

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
