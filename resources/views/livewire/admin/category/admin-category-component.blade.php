<section class="section">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-7">
                    All Categories Table
                    @if(Session::has('success'))
                    <span class="alert alert-success alert-dismissible show fade" role="alert" id="success-alert">{{Session::get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </span>
                    @elseif(Session::has('error'))
                    <span class="alert alert-error alert-dismissible show fade" role="alert" id="error-alert">{{Session::get('error')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </span>
                    @endif
                </div>
                <div class="col-md-3">
                    <input type="search" name="search" id="search" placeholder="search here..."
                        class="form-control float-right" wire:model="search">
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
                            <th style="font-size:11px;font-weight:700;" width="30px">ID</th>
                            <th style="font-size:11px;font-weight:700;">Name</th>
                            <th style="font-size:11px;font-weight:700;">Slug</th>
                            <th style="font-size:11px;font-weight:700;">SubCategories</th>
                            <th style="font-size:11px;font-weight:700;">Status</th>
                            <th style="font-size:11px;font-weight:700;">Date</th>
                            <th style="font-size:11px;font-weight:700;">SubCat.No</th>
                            <th style="font-size:11px;font-weight:700;">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $category->name }}</td>
                                <td style="font-size:12px;font-weight:900;">{{ $category->slug }}</td>
                                <td style="font-size:12px;font-weight:900;">
                                    @if($category->subcategories)
                                    @foreach($category->subcategories as $sub)
                                    <span class="badge bg-primary">{{ $sub->name }}</span>
                                    @endforeach
                                    @endif
                                </td>
                                <td style="font-size:12px;font-weight:900;">
                                    @if($category->status === 'active')
                                    <a href="#" wire:click.prevent="updateStatus('{{$category->id}}','inactive')"><span class="badge bg-success" style="text-transform: capitalize;">{{ $category->status }}</span></a>
                                    @else
                                    <a href="#" wire:click.prevent="updateStatus('{{$category->id}}','active')"><span class="badge bg-danger" style="text-transform: capitalize;">{{ $category->status }}</span></a>
                                    @endif

                                </td>
                                <td style="font-size:12px;font-weight:900;">{{ \Carbon\Carbon::parse($category->created_at)->isoFormat('MMM Do YYYY') }}</td>
                                <td style="font-size:12px;font-weight:900;"> {{$category->subcategories->count()}} </td>
                                <td style="font-size:12px;font-weight:900;"> <a href="{{route('admin.edit_category_form',['slug'=>$category->slug])}}" class="badge bg-primary"><i class="bi bi-pencil"></i></a></td>

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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

