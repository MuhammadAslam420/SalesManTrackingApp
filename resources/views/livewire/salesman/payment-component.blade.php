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
                @elseif(Session::has('error'))
                <span class="alert alert-danger alert-dismissible show fade" role="alert"
                        id="success-alert">{{ Session::get('error') }}
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
                    <div class="col-md-6">
                        <p class="title" style="font-weight: 900;">Add Payment</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="paymentAdd">
                    @csrf
                    <div class="mb-3">
                        <label for="partial" class="form-label">Enter Order Id</label>
                        <input type="text" name="order_id" id="order_id" class="form-control" wire:model="order_id">
                        @error('order_id')
                        <span class="text-danger">{{$message}}</span>

                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Select Shop</label>
                        <select class="form-select" id="customer_id" wire:model="customer_id">
                            <option value="">Select User</option>
                            @foreach($customers as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                        @error('customer_id')
                        <span class="text-danger">{{$message}}</span>

                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="partial" class="form-label">Payment Option</label>
                        <select class="form-select" id="partial" wire:model="selectedPaymentOption">
                            <option value="">Select Payment Option</option>
                            <option value="paid">Paid</option>
                            <option value="partial">Partial</option>
                        </select>
                        @error('selectedPaymentOption')
                        <span class="text-danger">{{$message}}</span>

                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="partial" class="form-label">Enter Amount</label>
                        <input type="text" name="payment" id="payment" class="form-control" wire:model="payment">
                        @error('payment')
                        <span class="text-danger">{{$message}}</span>

                        @enderror
                    </div>


                    <div class="mb-3 justify-content-end">
                        <button type="submit" class="btn btn-success float-right">Add Payment</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>
