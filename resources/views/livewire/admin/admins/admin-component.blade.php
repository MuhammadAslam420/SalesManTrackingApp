<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-5 order-md-1 order-last">
                <h3>All Administrations</h3>
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.administrator_create_form') }}">Add Admin</a>
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
                    <div class="col-md-7">
                        All Admin Users Table
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
                                <th style="font-size:11px;font-weight:900;color:black;">Name</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Mobile</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Email</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Status</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Date</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td style="font-size:12px;font-weight:900;">
                                        <div>
                                            <div class="avatar avatar-xl bg-warning me-3"><img
                                                    src="{{ asset('assets/images/faces') }}/{{ $admin->avatar }}"
                                                    width="120" alt=""></div>
                                            <p>Name:&nbsp;<span>{{ $admin->name }}</span></p>
                                        </div>
                                    </td>
                                    <td style="font-size:12px;font-weight:900;">{{ $admin->mobile }}</td>
                                    <td style="font-size:12px;font-weight:900;">{{ $admin->email }}</td>
                                    <td style="font-size:12px;font-weight:900;">
                                        @if ($admin->status === 'active')
                                            <a href="#"
                                                wire:click="updateStatus('{{ $admin->id }}', 'inactive')">
                                                <span class="badge bg-success" style="text-transform: capitalize;">
                                                    {{ $admin->status }}
                                                </span>
                                            </a>
                                        @else
                                            <a href="#"
                                                wire:click="updateStatus('{{ $admin->id }}', 'active')">
                                                <span class="badge bg-danger" style="text-transform: capitalize;">
                                                    {{ $admin->status }}
                                                </span>
                                            </a>
                                        @endif

                                    </td>
                                    <td style="font-size:12px;font-weight:900;">
                                        {{ \Carbon\Carbon::parse($admin->created_at)->isoFormat('MMM Do YYYY') }}
                                    </td>
                                    <td style="font-size:12px;font-weight:900;"> <a
                                            href="{{ route('admin.administrator_edit_form', ['adminId' => $admin->id]) }}"
                                            class="badge bg-primary"><i class="bi bi-pencil"></i></a></td>

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
                        {{ $admins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
