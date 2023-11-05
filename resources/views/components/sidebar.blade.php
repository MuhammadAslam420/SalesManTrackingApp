<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('admin.dashboard') }}"><img src="{{ asset('assets/images/logo/logo.png') }}"
                            alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/salesmen') ? 'active' : '' }}">
                    <a href="{{ route('admin.salesmen') }}" class='sidebar-link'>
                        <i class="bi bi-credit-card"></i>
                        <span>Salesman</span>
                    </a>
                </li>

                <li class="sidebar-item  {{ request()->is('admin/all/customers') ? 'active' : '' }}">
                    <a href="{{ route('admin.view_all_customers') }}" class='sidebar-link'>
                        <i class="bi bi-shop"></i>
                        <span>Customers</span>
                    </a>
                </li>

                <li class="sidebar-item  {{request()->is('admin/all/orders') ? 'active' : ''}}">
                    <a href="{{route('admin.all_orders')}}" class='sidebar-link'>
                        <i class="bi bi-bag-plus-fill"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('admin/products') ? 'active' : '' }}">
                    <a href="{{ route('admin.products') }}" class='sidebar-link'>
                        <i class="bi bi-basket"></i>
                        <span>Products</span>
                    </a>
                </li>
                <li class="sidebar-item" {{ request()->is('admin/categories') ? 'active' : '' }}>
                    <a href="{{ route('admin.categories') }}" class='sidebar-link'>
                        <i class="bi bi-tag-fill"></i>
                        <span>Category</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ request()->is('admin/view/all/routes') ? 'active' : '' }}">
                    <a href="{{ route('admin.view_all_routes') }}" class='sidebar-link'>
                        <i class="bi bi-map"></i>
                        <span>Routes</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ request()->is('admin/file-manager') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage_files') }}" class='sidebar-link'>
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                        <span>FileManager</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ request()->is('admin/settings') ? 'active' : '' }}">
                    <a href="{{ route('admin.settings') }}" class='sidebar-link'>
                        <i class="bi bi-gear"></i>
                        <span>Setting</span>
                    </a>
                </li>
                <li class="sidebar-title">Admin & Profile Setting</li>

                <li class="sidebar-item {{ request()->is('admin/administration') ? 'active' : '' }}">
                    <a href="{{ route('admin.administration') }}" class='sidebar-link'>
                        <i class="bi bi-person"></i>
                        <span>Admin</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ request()->is('admin/logout') ? 'active' : '' }}">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();"
                        class="sidebar-link">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                    <form id="form-logout" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>

                <li class="sidebar-item  {{ request()->is('admin/profile') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}" class='sidebar-link'>
                        <i class="bi bi-person"></i>
                        <span>Profile Setting</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->is('admin/profile') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile') }}" class='sidebar-link'>
                        <i class="bi bi-lock"></i>
                        <span>Password Reset</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
