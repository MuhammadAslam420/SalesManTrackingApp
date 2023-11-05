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
                        <p class="title" style="font-weight: 900;">Total Amount :  {{Cart::total()}}</p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="checkout">
                    @csrf
                    <div class="mb-3">
                        <label for="userSelect" class="form-label">Select User</label>
                        <select class="form-select" id="userSelect" wire:model="selectedUserId">
                            <option value="">Select User</option>
                            @foreach($customers as $user)
                                <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                        @error('selectedUserId')
                        <span class="text-danger">{{$message}}</span>

                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="partial" class="form-label">Payment Option</label>
                        <select class="form-select" id="partial" wire:model="selectedPaymentOption">
                            <option value="">Select Payment Option</option>
                            <option value="paid">Paid</option>
                            <option value="on_delivery">On Delivery</option>
                            <option value="partial">Partial</option>
                        </select>
                        @error('selectedPaymentOption')
                        <span class="text-danger">{{$message}}</span>

                        @enderror
                    </div>

                    @if($selectedPaymentOption == 'partial')
                    <div class="mb-3">
                        <label for="partial" class="form-label">Enter Amount</label>
                        <input type="text" name="partial_amount" id="partial_amount" class="form-control" wire:model="partial_amount">
                        @error('partial_amount')
                        <span class="text-danger">{{$message}}</span>

                        @enderror
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="deliveryDate" class="form-label">Delivery Date</label>
                        <input type="date" class="form-control" id="deliveryDate" wire:model="deliveryDate">
                        @error('deliveryDate')
                        <span class="text-danger">{{$message}}</span>

                        @enderror
                    </div>

                    <div class="mb-3 justify-content-end">
                        <button type="submit" class="btn btn-success float-right">Checkout Now</button>
                    </div>
                </form>

            </div>
        </div>
    </section>
</div>
