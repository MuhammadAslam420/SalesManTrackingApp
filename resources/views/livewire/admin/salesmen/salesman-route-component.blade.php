<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-5">
                    Routes Table
                </div>
                <div class="col-md-4">
                    @if (Session::has('message'))
                        <div class="alert alert-success alert-dismissible show fade">
                            {{ Session::get('message') }}
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
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="font-size:12px;font-weight:700;" width="30px">@sortablelink('id', 'ID')</th>
                            <th style="font-size:12px;font-weight:700;">@sortablelink('name', 'Name')</th>
                            <th style="font-size:12px;font-weight:700;">@sortablelink('salesman_id', 'Salesman')</th>
                            <th style="font-size:12px;font-weight:700;">@sortablelink('status', 'Status')</th>
                            <th style="font-size:12px;font-weight:700;">Shops</th>
                            <th style="font-size:12px;font-weight:700;">@sortablelink('visit_day', 'Visit Day')</th>
                            <th style="font-size:12px;font-weight:700;">@sortablelink('assigned_by_id', 'AssignedBy')</th>
                            <th style="font-size:12px;font-weight:700;">@sortablelink('created_at', 'Date')</th>
                            <th style="font-size:12px;font-weight:700;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($routes as $route )
                            <tr>
                                <td style="font-size:12px;font-weight:900;">{{ $route->id }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $route->name }}</td>
                                <td style="font-size:12px;font-weight:900;"><span
                                        class="badge bg-dark">{{ $route->salesman->name }}</span></td>
                                <td style="font-size:12px;font-weight:900;">
                                    @if($route->status === 'deleted')
                                    <span class="badge bg-danger"
                                        style="text-transform:capitalize;"><a href="#" wire:click.prevent="updateStatus('{{$route->id}}','active')" style="text-decoration: none;color:white;">{{ $route->status }}</a></span>
                                    @elseif($route->status === 'inactive')
                                    <span class="badge bg-danger"
                                        style="text-transform:capitalize;"><a href="#" wire:click.prevent="updateStatus('{{$route->id}}','active')" style="text-decoration: none;color:white;">{{ $route->status }}</a></span>
                                    @else
                                    <span class="badge bg-success"
                                        style="text-transform:capitalize;"><a href="#" wire:click.prevent="updateStatus('{{$route->id}}','inactive')" style="text-decoration: none;color:white;">{{ $route->status }}</a></span>
                                    @endif

                                </td>
                                <td style="font-size:12px;font-weight:900;">
                                   @if($route->routeCustomer)
                                   @php
                                   $customers = explode(',', $route->routeCustomer->customer_id);
                               @endphp
                               @foreach ($customers as $customer)
                                   @if ($customer)
                                       @php
                                           $shop = DB::table('customers')
                                               ->where('id', $customer)
                                               ->first();
                                       @endphp
                                       <span class="badge bg-primary">{{ $shop->shopname }}</span>
                                   @endif
                               @endforeach
                               @endif
                                </td>
                                <td style="font-size:12px;font-weight:900;"><span class="badge bg-warning text-dark"
                                        style="text-transform:capitalize;">{{ $route->visit_day }}</span></td>
                                <td style="font-size:12px;font-weight:900;"><span
                                        class="badge bg-info">{{ $route->assignedBy->name }}</span></td>
                                <td style="font-size:12px;font-weight:900;">
                                    {{ \Carbon\Carbon::parse($route->created_at)->isoFormat('MMM Do YYYY') }}</td>
                                <td>
                                    <div class="d-flex">
                                        @if ($route->routeCustomer)
                                        @if($route->deleted_at == NULL && $route->status !='deleted')
                                        <div class="modal-danger me-1 mb-1 d-inline-block">
                                            <!-- Button trigger for danger theme modal -->
                                            <a href="#" class="badge bg-danger" data-bs-toggle="modal"
                                                data-bs-target="#danger{{ $route->id }}"
                                                style="font-size:12px;font-weight:900;">
                                                <span class="bi bi-trash"></span>
                                            </a>

                                            <!--Danger theme Modal -->
                                            <div class="modal fade text-left" id="danger{{ $route->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="myModalLabel120"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title white" id="myModalLabel120">
                                                                Delete This Route
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <i data-feather="x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure, You want to delete this route?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <a href="{{ route('admin.delete_route', ['routeId' => $route->id]) }}"
                                                                class="btn btn-danger">
                                                                <span class="ml-2">Delete Route</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                            <a style="font-size:12px;font-weight:900;text-decoration:none;"
                                                href="{{ route('admin.edit_customers_to_route', ['routeId' => $route->id]) }}"
                                                class="badge bg-primary">
                                                Edit Customers
                                            </a>

                                         @endif
                                        @else
                                            <a style="font-size:12px;font-weight:900;"
                                                href="{{ route('admin.addd_customers_to_route_form', ['routeId' => $route->id]) }}"
                                                class="badge bg-info">Assign Customers</a>
                                        @endif
                                        <a href="{{route('admin.edit_salesman_route',['routeId'=>$route->id])}}" class="badge bg-primary"><span>Edit Route</span></a>
                                        <a href="{{route('admin.view_route_map',['routeId'=>$route->id])}}" class="badge bg-info" style="font-size:12px;font-weight:900;"><span class="bi bi-map"></span></a>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <p>Ops No routes found</p>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
                <div class="pagination" >
                {{ $routes->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
