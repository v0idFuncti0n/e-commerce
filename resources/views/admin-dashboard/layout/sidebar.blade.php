<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile not-navigation-link">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img class="img-md rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ Auth::user()->name }}</p>
                        <div class="dropdown" data-display="static">
                            <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown"
                               data-toggle="dropdown" aria-expanded="false">
                                <small
                                    class="designation text-muted">{{ Auth::user()->getRoleNames()->first() }}</small>
                                <span class="status-indicator online"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                                <a href="{{ route('profile.show') }}" class="dropdown-item"> Manage Profile </a>
                                <a href="{{ route('home') }}" class="dropdown-item"> Ecommerce Home </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item"
                                            onclick="e.preventDefault(); this.closest('form').submit();"> Sign Out
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <li class="nav-item {{ active_class(['admin/dashboard']) }}">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/categories/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#categories"
               aria-expanded="{{ is_active_route(['admin/categories/*']) }}" aria-controls="categories">
                <i class="menu-icon mdi mdi-format-list-bulleted-square"></i>
                <span class="menu-title">Categories</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['admin/categories/*']) }}" id="categories">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['admin/categories/categories']) }}">
                        <a class="nav-link" href="{{ route('admin.categories') }}">Categories</a>
                    </li>
                    <li class="nav-item {{ active_class(['admin/categories/sub-categories']) }}">
                        <a class="nav-link" href="{{ route('admin.subCategories') }}">Sub Categories</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['admin/coupons']) }}">
            <a class="nav-link" href="{{ route('admin.coupons') }}">
                <i class="menu-icon mdi mdi-ticket-percent"></i>
                <span class="menu-title">Coupon</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/products/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#products"
               aria-expanded="{{ is_active_route(['admin/products/*']) }}" aria-controls="products">
                <i class="menu-icon mdi mdi-plus-box"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['admin/products/*']) }}" id="products">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['admin/products/create']) }}">
                        <a class="nav-link" href="{{ route('admin.products.create') }}">Add Product</a>
                    </li>
                    <li class="nav-item {{ active_class(['admin/products/all']) }}">
                        <a class="nav-link" href="{{ route('admin.products') }}">All Product</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ active_class(['admin/orders']) }}">
            <a class="nav-link" href="{{ route('admin.orders') }}">
                <i class="menu-icon mdi mdi-account-cash"></i>
                <span class="menu-title">Orders</span>
            </a>
        </li>
    </ul>
</nav>
