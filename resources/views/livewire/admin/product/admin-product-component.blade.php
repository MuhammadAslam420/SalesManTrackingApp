<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-5 order-md-1 order-last">
                <h3>All Products</h3>
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.product_create_form') }}">Add Product</a>
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
                    <div class="col-md-12 flex m-1">
                            <a href="#" wire:click.prevent="exportProduct" class="btn btn-info">
                                <i class="bi bi-clipboard-data"></i>Export Products XLS Format</a>
                            <a href="#" wire:click.prevent="exportProductCsv" class="btn btn-info">
                                <i class="bi bi-clipboard-data"></i>Export Products CSV Format</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-md-6">
                        <input type="search" name="search" id="search"
                            placeholder="ID, name, SKU, status, date search here..." class="form-control float-right"
                            wire:model="search">
                    </div>
                    <div class="col-md-3">
                        <select name="perPage" id="perPage" class="form-control" wire:model="perPage">
                            <option value="10">10</option>
                            <option value="16">16</option>
                            <option value="24">24</option>
                            <option value="32">32</option>
                            <option value="48">48</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="sorting" id="sorting" class="form-control" wire:model="sorting">
                            <option value="asc">ASC</option>
                            <option value="desc">DESC</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="font-size:11px;font-weight:900;color:black;" width="30px">ID</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Product</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Description</th>
                                <th style="font-size:11px;font-weight:900;color:black;">StockIn</th>
                                <th style="font-size:11px;font-weight:900;color:black;">SKU</th>
                                <th style="font-size:11px;font-weight:900;color:black;">QTY</th>
                                <th style="font-size:11px;font-weight:900;color:black;">S.Qty</th>
                                <th style="font-size:11px;font-weight:900;color:black;">p.Cost</th>
                                <th style="font-size:11px;font-weight:900;color:black;">S.Cost</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Discount</th>
                                <th style="font-size:11px;font-weight:900;color:black;">D.Qty</th>
                                <th style="font-size:11px;font-weight:900;color:black;">D.Date</th>
                                <th style="font-size:11px;font-weight:900;color:black;">D.Date</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Status</th>
                                <th style="font-size:11px;font-weight:900;color:black;">S.Category</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Date</th>
                                <th style="font-size:11px;font-weight:900;color:black;">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td style="font-size:12px;font-weight:900;">
                                        <div>
                                            <div class="avatar avatar-xl bg-warning me-3"><img
                                                    src="{{ asset('assets/images/products') }}/{{ $product->image }}"
                                                    width="120" alt=""></div>
                                            <p>Name:&nbsp;<span>{{ $product->name }}</span></p>
                                            <p>Slug:&nbsp;<span>{{ $product->slug }}</span></p>
                                        </div>
                                    </td>
                                    <td style="font-size:12px;font-weight:900;">{!! $product->description !!}</td>
                                    <td style="font-size:12px;font-weight:900;">{{ $product->stockIn }}</td>
                                    <td style="font-size:12px;font-weight:900;">{{ $product->SKU }}</td>
                                    <td style="font-size:12px;font-weight:900;">{{ $product->qty }}</td>
                                    <td style="font-size:12px;font-weight:900;">{{ $product->sale_qty }}</td>
                                    <td style="font-size:12px;font-weight:900;">{{ $product->purchase_cost }}</td>
                                    <td style="font-size:12px;font-weight:900;">{{ $product->sale_cost }}</td>
                                    <td style="font-size:12px;font-weight:900;">{{ $product->discount_percentage }}%
                                    </td>
                                    <td style="font-size:12px;font-weight:900;">{{ $product->discount_on_qty }}</td>
                                    <td style="font-size:12px;font-weight:900;">{{ $product->discount_date_start }}
                                    </td>
                                    <td style="font-size:12px;font-weight:900;">{{ $product->discount_date_end }}</td>
                                    <td style="font-size:12px;font-weight:900;">
                                        @if ($product->status === 'active')
                                            <a href="#"
                                                wire:click="updateStatus('{{ $product->id }}', 'inactive')">
                                                <span class="badge bg-success" style="text-transform: capitalize;">
                                                    {{ $product->status }}
                                                </span>
                                            </a>
                                        @else
                                            <a href="#"
                                                wire:click="updateStatus('{{ $product->id }}', 'active')">
                                                <span class="badge bg-danger" style="text-transform: capitalize;">
                                                    {{ $product->status }}
                                                </span>
                                            </a>
                                        @endif

                                    </td>

                                    <td style="font-size:12px;font-weight:900;">
                                        <span class="badge bg-primary">{{ $product->subcategory->name }}</span>
                                    </td>
                                    <td style="font-size:12px;font-weight:900;">
                                        {{ \Carbon\Carbon::parse($product->created_at)->isoFormat('MMM Do YYYY') }}
                                    </td>
                                    <td style="font-size:12px;font-weight:900;"> <a
                                            href="{{ route('admin.edit_product_form', ['productId' => $product->id]) }}"
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
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
