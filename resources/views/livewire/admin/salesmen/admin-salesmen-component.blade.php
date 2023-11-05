<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-5">
                    Salesman Table
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
                            <th style="font-size:11px;font-weight:700;" width="30px">@sortablelink('id', 'ID')</th>
                            <th style="font-size:11px;font-weight:700;">@sortablelink('name', 'Name')</th>
                            <th style="font-size:11px;font-weight:700;">@sortablelink('username', 'UserName')</th>
                            <th style="font-size:11px;font-weight:700;">@sortablelink('employee_no', 'Emp No')</th>
                            <th style="font-size:11px;font-weight:700;">@sortablelink('email', 'Email')</th>
                            <th style="font-size:11px;font-weight:700;">@sortablelink('mobile', 'Mobile')</th>
                            <th style="font-size:11px;font-weight:700;">@sortablelink('status', 'Status')</th>
                            <th style="font-size:11px;font-weight:700;">@sortablelink('online', 'ON/OFF')</th>
                            <th style="font-size:11px;font-weight:700;">@sortablelink('city', 'City')</th>
                            <th style="font-size:11px;font-weight:700;">@sortablelink('created_at', 'Date')</th>
                            <th style="font-size:11px;font-weight:700;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($salesmen as $saleman)
                            <tr>
                                <td>{{ $saleman->id }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $saleman->name }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $saleman->username }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $saleman->employee_no }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $saleman->email }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $saleman->mobile }}</td>
                                <td style="font-size:12px;font-weight:900;">
                                    @if ($saleman->status === 'active')
                                        <span class="badge bg-success" style="text-transform: capitalize">
                                            <a href="#" class="text-light"
                                                wire:click.prevent="updateStatus('{{ $saleman->id }}','inactive')">{{ $saleman->status }}</a>
                                        </span>
                                    @elseif($saleman->status ==='inactive')
                                        <span class="badge bg-warning" style="text-transform: capitalize">
                                            <a href="#" class="text-light"
                                                wire:click.prevent="updateStatus('{{ $saleman->id }}','active')">{{ $saleman->status }}</a>
                                        </span>
                                    @else
                                    <span class="badge bg-danger" style="text-transform: capitalize">
                                        <a href="#" class="text-light"
                                            wire:click.prevent="updateStatus('{{ $saleman->id }}','active')">{{ $saleman->status }}</a>
                                    </span>
                                    @endif
                                </td>
                                <td style="font-size:12px;font-weight:900;">
                                    @if ($saleman->online === 'online')
                                        <span class="badge bg-success text-light">ON</span>
                                    @else
                                        <span class="badge bg-danger text-light">OFF</span>
                                    @endif
                                </td>
                                <td style="font-size:12px;font-weight:900;">{{ $saleman->city }}</td>
                                <td style="font-size:12px;font-weight:900;">
                                    {{ \Carbon\Carbon::parse($saleman->created_at)->isoFormat('MMM Do YYYY') }}</td>
                                @if ($saleman->username != null)
                                    <td style="font-size:12px;font-weight:900;">
                                        <div class="relative" x-data="{ isOpen: false }">
                                            <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
                                                class="flex items-center btn btn-default "
                                                style="font-size:12px;font-weight:900;">
                                                Links
                                            </button>
                                            <ul x-show="isOpen" style="padding:5px;margin:5px;"
                                                @click.away="isOpen = false">
                                                <li>
                                                    <a
                                                        href="{{ route('admin.salesman_profile', ['slug' => $saleman->username]) }}">
                                                        <span class="ml-2">Detail</span>
                                                    </a>
                                                </li>
                                                <li class="border-b border-gray-400">
                                                    <a
                                                        href="{{ route('admin.routes_form', ['salesmanId' => $saleman->id]) }}">
                                                        <span class="ml-2">Add Routes</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a
                                                        href="{{ route('admin.salesman.edit', ['salesmanId' => $saleman->id]) }}">
                                                        <span class="ml-2">Edit Salesman</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('admin.edit_salesman_pay', ['salesmanId' => $saleman->id]) }}">
                                                        <span class="ml-2">Edit Finacial</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <div class="modal-danger me-1 mb-1 d-inline-block">
                                                        <!-- Button trigger for danger theme modal -->
                                                        <a href="#"
                                                            data-bs-toggle="modal" data-bs-target="#danger{{$saleman->id}}">
                                                            Delete
                                                        </a>

                                                        <!--Danger theme Modal -->
                                                        <div class="modal fade text-left" id="danger{{$saleman->id}}" tabindex="-1"
                                                            role="dialog" aria-labelledby="myModalLabel120"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-danger">
                                                                        <h5 class="modal-title white" id="myModalLabel120">
                                                                            Delete Salesman
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i data-feather="x"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                       <p>Are you sure, You want to delete this salesman?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-light-secondary"
                                                                            data-bs-dismiss="modal">
                                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                                            <span class="d-none d-sm-block">Close</span>
                                                                        </button>
                                                                        <a href="{{ route('admin.deleted_salesman',['salesmanId'=>$saleman->id]) }}" class="btn btn-danger">
                                                                            <span class="ml-2">Delete Salesman</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                @else
                                    <td style="font-size:12px;font-weight:900;">
                                        <div class="relative" x-data="{ isOpen: false }">
                                            <button @click="isOpen = !isOpen" @keydown.escape="isOpen = false"
                                                class="flex items-center btn btn-default"
                                                style="font-size:12px;font-weight:900;">
                                                Links
                                            </button>
                                            <ul x-show="isOpen" style="padding:5px;margin:5px;"
                                                @click.away="isOpen = false">
                                                <li>
                                                    <a href="#">
                                                        <span class="ml-2">Detail</span>
                                                    </a>
                                                </li>
                                                <li class="border-b border-gray-400">
                                                    <a
                                                        href="{{ route('admin.routes_form', ['salesmanId' => $saleman->id]) }}">
                                                        <span class="ml-2">Add Routes</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <a
                                                        href="{{ route('admin.salesman.edit', ['salesmanId' => $saleman->id]) }}">
                                                        <span class="ml-2">Edit Salesman</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a
                                                        href="{{ route('admin.edit_salesman_pay', ['salesmanId' => $saleman->id]) }}">
                                                        <span class="ml-2">Edit Finacial</span>
                                                    </a>
                                                </li>

                                                <li>
                                                    <div class="modal-danger me-1 mb-1 d-inline-block">
                                                        <!-- Button trigger for danger theme modal -->
                                                        <a href="#"
                                                            data-bs-toggle="modal" data-bs-target="#danger{{$saleman->id}}">
                                                            Delete
                                                        </a>

                                                        <!--Danger theme Modal -->
                                                        <div class="modal fade text-left" id="danger{{$saleman->id}}" tabindex="-1"
                                                            role="dialog" aria-labelledby="myModalLabel120"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header bg-danger">
                                                                        <h5 class="modal-title white" id="myModalLabel120">
                                                                            Delete Salesman
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <i data-feather="x"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                       <p>Are you sure, You want to delete this salesman?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-light-secondary"
                                                                            data-bs-dismiss="modal">
                                                                            <i class="bx bx-x d-block d-sm-none"></i>
                                                                            <span class="d-none d-sm-block">Close</span>
                                                                        </button>
                                                                        <a href="{{ route('admin.deleted_salesman',['salesmanId'=>$saleman->id]) }}" class="btn btn-danger">
                                                                            <span class="ml-2">Delete Salesman</span>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
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
                {{ $salesmen->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

