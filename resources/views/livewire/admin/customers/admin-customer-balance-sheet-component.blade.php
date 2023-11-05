<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-7">
                    Customers Balance Sheet Table
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
                            <th style="font-size:11px;font-weight:700;">TotalPaid</th>
                            <th style="font-size:11px;font-weight:700;">Remaining</th>
                            <th style="font-size:11px;font-weight:700;">Date</th>
                            <th style="font-size:11px;font-weight:700;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($balances as $balance)
                            <tr>
                                <td>{{ $balance->id }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $balance->order_id }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $balance->total }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $balance->paid }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $balance->remaining }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ \Carbon\Carbon::parse($balance->created_at)->isoFormat('MMM Do YYYY') }}</td>
                                <td style="font-size:12px;font-weight:900;">
                                    <div class="relative" x-data="{ isOpen: false }">
                                        <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
                                            class="flex items-center btn btn-default "
                                            style="font-size:12px;font-weight:900;">
                                            Links
                                        </button>
                                        <ul x-show="isOpen" style="padding:5px;margin:5px;"
                                            @click.away="isOpen = false">
                                            <li><a href="@">Profile</a></li>
                                            <li><a href="#">Detail</a></li>
                                        </ul>
                                    </div>
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
                {{ $balances->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
