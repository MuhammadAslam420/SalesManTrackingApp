<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('salesman.dashboard') }}"><img src="{{ asset('assets/images/logo/logo.png') }}"
                            alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item {{ request()->is('salesman/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('salesman.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->is('salesman/payment') ? 'active' : '' }}">
                    <a href="{{ route('salesman.payment') }}" class='sidebar-link'>
                        <i class="bi bi-credit-card"></i>
                        <span>Payment</span>
                    </a>
                </li>
                <li class="sidebar-item  {{(request()->is('salesman/orders')) ? 'active' : ''}}">
                    <a href="{{route('salesman.orders')}}" class='sidebar-link'>
                        <i class="bi bi-bag-plus-fill"></i>
                        <span>Orders</span>
                    </a>
                </li>
                <li class="sidebar-item  {{(request()->is('salesman/shop')) ? 'active' : ''}}">
                    <a href="{{route('salesman.shop')}}" class='sidebar-link'>
                        <i class="bi bi-shop"></i>
                        <span>Shop</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ request()->is('salesman/my-routes') ? 'active' : '' }}">
                    <a href="{{ route('salesman.my_routes') }}" class='sidebar-link'>
                        <i class="bi bi-map"></i>
                        <span>My Routes</span>
                    </a>
                </li>
                <li class="sidebar-title">Salesman & Profile Setting</li>
                <li class="sidebar-item {{ request()->is('salesman/profile') ? 'active' : '' }}">
                    <a href="{{ route('salesman.profile') }}" class='sidebar-link'>
                        <i class="bi bi-person"></i>
                        <span>Salesman</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ request()->is('salesman/logout') ? 'active' : '' }}">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();"
                        class="sidebar-link">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                    <form id="form-logout" action="{{ route('salesman.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                <li class="sidebar-item {{ request()->is('salesman/reset-password') ? 'active' : '' }}">
                    <a href="{{ route('salesman.reset-password') }}" class='sidebar-link'>
                        <i class="bi bi-lock"></i>
                        <span>Password Reset</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>