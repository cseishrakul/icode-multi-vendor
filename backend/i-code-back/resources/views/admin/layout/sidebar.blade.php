<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        @if (Auth::guard('admin')->user()->type == 'vendor')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false"
                    aria-controls="ui-basic2">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Vendor Details</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ url('admin/update-vendor-details/personal') }}">Personal Details</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ url('admin/update-vendor-details/business') }}">Business
                                Details</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ url('admin/update-vendor-details/bank') }}">Bank
                                Details</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false"
                    aria-controls="ui-basic6">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Catalouge</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic6">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products') }}">Products</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/coupons') }}">Coupons</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic20" aria-expanded="false"
                    aria-controls="ui-basic20">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Order Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic20">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/orders') }}">Orders</a>
                        </li>
                    </ul>
                </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false"
                    aria-controls="ui-basic3">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Settings</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic3">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/update-admin-password') }}">Update
                                Password</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/update-admin-details') }}">Update
                                Details</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false"
                    aria-controls="ui-basic4">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Admin Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic4">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins/') }}">All</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins/admin') }}">Admins</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ url('admin/admins/subadmin') }}">Subadmins</a></li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/admins/vendor') }}">Vendors</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false"
                    aria-controls="ui-basic5">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">User Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic5">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/users') }}">Users</a></li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ url('admin/subscribers') }}">Subcribers</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false"
                    aria-controls="ui-basic6">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Catalouge</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic6">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/sections') }}">Sections</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link"
                                href="{{ url('admin/categories') }}">Categories</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/brands') }}">Brands</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products') }}">Products</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/coupons') }}">Coupons</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/filters') }}">Filters</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic20" aria-expanded="false"
                    aria-controls="ui-basic20">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Order Management</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic20">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/orders') }}">Orders</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic7" aria-expanded="false"
                    aria-controls="ui-basic7">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Banners</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic7">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/banners') }}">Home Page
                                Banners</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic8" aria-expanded="false"
                    aria-controls="ui-basic8">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Shipping</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic8">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="{{ url('admin/shipping-charges') }}">Shipping Charges</a></li>
                    </ul>
                </div>
            </li>
        @endif
        
    </ul>
</nav>
