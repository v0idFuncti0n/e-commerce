<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="{{ url('/') }}">
            <img src="{{ url('assets/images/logo-mini.svg') }}" alt="logo"/> </a>
        <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
            <img src="{{ url('assets/images/logo-mini.svg') }}" alt="logo"/> </a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-left header-links">
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item dropdown d-none d-xl-inline-block">
                <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown"
                   aria-expanded="false">
                    <span class="profile-text d-none d-md-inline-flex">{{ Auth::user()->name }}</span>
                    <img class="img-xs rounded-circle" src="{{ Auth::user()->profile_photo_url }}"
                         alt="{{ Auth::user()->name }}"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <a href="{{ route('profile.show') }}" class="dropdown-item"> Manage Profile </a>
                    <a href="{{ route('home') }}" class="dropdown-item"> Ecommerce Home </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item">
                            <a onclick="e.preventDefault(); this.closest('form').submit();"> Sign Out</a>
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="mdi mdi-menu icon-menu"></span>
        </button>
    </div>
</nav>
