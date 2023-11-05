<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('customer.dashboard') }}"><img src="{{ asset('assets/images/logo/logo.png') }}"
                            alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item {{ request()->is('customer/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('customer.dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-title">Customer & Profile Setting</li>
                <li class="sidebar-item {{ request()->is('customer/profile') ? 'active' : '' }}">
                    <a href="{{ route('customer.profile') }}" class='sidebar-link'>
                        <i class="bi bi-person"></i>
                        <span>Customer</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ request()->is('customer/logout') ? 'active' : '' }}">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('form-logout').submit();"
                        class="sidebar-link">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </a>
                    <form id="form-logout" action="{{ route('customer.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                <li class="sidebar-item {{ request()->is('customer/reset-password') ? 'active' : '' }}">
                    <a href="{{ route('customer.reset-password') }}" class='sidebar-link'>
                        <i class="bi bi-lock"></i>
                        <span>Password Reset</span>
                    </a>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
