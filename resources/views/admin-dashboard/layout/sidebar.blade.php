<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile not-navigation-link">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
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
                                <a class="dropdown-item"> Manage Accounts </a>
                                <a class="dropdown-item"> Change Password </a>
                                <a class="dropdown-item"> Check Inbox </a>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item"
                                       onclick="e.preventDefault(); this.closest('form').submit();"> Sign Out </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-success btn-block">New Project <i class="mdi mdi-plus"></i>
                </button>
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
                    <li class="nav-item {{ active_class(['admin/categories/sub_categories']) }}">
                        <a class="nav-link" href="{{ route('admin.subCategories') }}">Sub Categories</a>
                    </li>
                </ul>
            </div>
        </li>
        </li>
        <li class="nav-item {{ active_class(['admin/coupons']) }}">
            <a class="nav-link" href="{{ route('admin.coupons') }}">
                <i class="menu-icon mdi mdi-format-list-bulleted-square"></i>
                <span class="menu-title">Coupon</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/basic-ui/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#basic-ui"
               aria-expanded="{{ is_active_route(['admin/basic-ui/*']) }}" aria-controls="basic-ui">
                <i class="menu-icon mdi mdi-dna"></i>
                <span class="menu-title">Basic UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['admin/basic-ui/*']) }}" id="basic-ui">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['admin/basic-ui/buttons']) }}">
                        <a class="nav-link" href="{{ url('admin/basic-ui/buttons') }}">Buttons</a>
                    </li>
                    <li class="nav-item {{ active_class(['admin/basic-ui/dropdowns']) }}">
                        <a class="nav-link" href="{{ url('admin/basic-ui/dropdowns') }}">Dropdowns</a>
                    </li>
                    <li class="nav-item {{ active_class(['admin/basic-ui/typography']) }}">
                        <a class="nav-link" href="{{ url('admin/basic-ui/typography') }}">Typography</a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ active_class(['admin/charts/chartjs']) }}">
            <a class="nav-link" href="{{ url('admin/charts/chartjs') }}">
                <i class="menu-icon mdi mdi-chart-line"></i>
                <span class="menu-title">Charts</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/tables/basic-table']) }}">
            <a class="nav-link" href="{{ url('admin/tables/basic-table') }}">
                <i class="menu-icon mdi mdi-table-large"></i>
                <span class="menu-title">Tables</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/icons/material']) }}">
            <a class="nav-link" href="{{ url('admin/icons/material') }}">
                <i class="menu-icon mdi mdi-emoticon"></i>
                <span class="menu-title">Icons</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['admin/user-pages/*']) }}">
            <a class="nav-link" data-toggle="collapse" href="#user-pages"
               aria-expanded="{{ is_active_route(['admin/user-pages/*']) }}" aria-controls="user-pages">
                <i class="menu-icon mdi mdi-lock-outline"></i>
                <span class="menu-title">User Pages</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ show_class(['admin/user-pages/*']) }}" id="user-pages">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ active_class(['admin/user-pages/login']) }}">
                        <a class="nav-link" href="{{ url('admin/user-pages/login') }}">Login</a>
                    </li>
                    <li class="nav-item {{ active_class(['admin/user-pages/register']) }}">
                        <a class="nav-link" href="{{ url('admin/user-pages/register') }}">Register</a>
                    </li>
                    <li class="nav-item {{ active_class(['admin/user-pages/lock-screen']) }}">
                        <a class="nav-link" href="{{ url('admin/user-pages/lock-screen') }}">Lock Screen</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link"
               href="https://www.bootstrapdash.com/demo/star-laravel-free/documentation/documentation.html"
               target="_blank">
                <i class="menu-icon mdi mdi-file-outline"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
    </ul>
</nav>
