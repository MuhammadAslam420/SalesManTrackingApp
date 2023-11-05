<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-5 order-md-1 order-last">
                <h3>Customer {{auth('customer')->user()->name}} Reset Your Password</h3>
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
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <h4>Reset Password</h4>
                </div>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="updatePassword">
                    @csrf
                    <div class="form-group">
                        <label  class="label-control">Current Password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control" wire:model="current_password">
                        @error('current_password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label  class="label-control">New Password</label>
                        <input type="password" name="password" id="password" class="form-control" wire:model="password">
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label  class="label-control">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" wire:model="password_confirmation">
                        @error('password_confirmation')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary float-right">Reset Password</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
