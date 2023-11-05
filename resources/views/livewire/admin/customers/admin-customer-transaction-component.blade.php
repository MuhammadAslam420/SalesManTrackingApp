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
                            <th style="font-size:11px;font-weight:700;">OrderID</th>
                            <th style="font-size:11px;font-weight:700;">OrderTotal</th>
                            <th style="font-size:11px;font-weight:700;">Status</th>
                            <th style="font-size:11px;font-weight:700;">PaymentMode</th>
                            <th style="font-size:11px;font-weight:700;">Date</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $transaction->order_id }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $transaction->total }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $transaction->status }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $transaction->payment_mode }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ \Carbon\Carbon::parse($transaction->created_at)->isoFormat('MMM Do YYYY') }}</td>
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
                {{ $transactions->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
