<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-5 order-md-1 order-last">
                <h3>{{auth('admin')->user()->name}} Profile</h3>
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="avatar avatar-xl bg-warning me-3">
                            <img src="{{asset('assets/images/faces')}}/{{$avatar}}">
                        </div>
                        <form wire:submit.prevent="resetPassword">
                            <div class="form-group">
                                <label for="password" class="label-control">Password</label>
                                <input type="password" name="password" id="password" wire:model="password" class="form-control">
                            </div>
                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <form wire:submit.prevent="updateProfile" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="label-control">Name</label>
                                <input type="text" name="name"  class="form-control" wire:model="name">
                            </div>
                            <div class="form-group">
                                <label class="label-control">Email</label>
                                <input type="text" name="email"  class="form-control" wire:model="email">
                            </div>
                            <div class="form-group">
                                <label for="" class="label-control">Mobile</label>
                                <input type="text" name="mobile"  class="form-control" wire:model="mobile">
                            </div>


                            <div class="form-group d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
