<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>E-clothing</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('e-commerce/css/bootstrap.min.css') }}" rel="stylesheet">
    Material Design Bootstrap
    <link href="{{ asset('e-commerce/css/mdb.min.css') }}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{ asset('e-commerce/css/style.min.css') }}" rel="stylesheet">
    {!! Html::style('/css/toastr.css') !!}
    <style type="text/css">
        html,
        body,
        header,
        .carousel {
            height: 60vh;
        }

        @media (max-width: 740px) {

            html,
            body,
            header,
            .carousel {
                height: 100vh;
            }
        }

        @media (min-width: 800px) and (max-width: 850px) {

            html,
            body,
            header,
            .carousel {
                height: 100vh;
            }
        }

    </style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect">
            <strong class="blue-text">E-clothing</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link waves-effect" href="{{ route('home') }}">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            </ul>

            <!-- Right -->
            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item">
                    <a href="{{ route('showCart') }}" class="nav-link waves-effect">
                        <span id="cart-count" class="badge red z-depth-1 mr-1"> {{ Cart::count() }} </span>
                        <i class="fas fa-shopping-cart"></i>
                        <span class="clearfix d-none d-sm-inline-block"> Cart </span>
                    </a>
                </li>

                    @auth
                    <li class="mt-2 nav-item dropdown">
                            <a class="dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
                                <img class="img-xs rounded-circle" style="width: 2rem;height: 2rem" src="{{ Auth::user()->profile_photo_url }}">
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                                @role('admin')
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                @endrole
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('profile.show')}}">Edit Profile</a></li>
                                <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('show.orders')}}">My Orders</a></li>
                                <li role="presentation" class="divider"></li>
                                <li role="presentation">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <a role="menuitem" tabindex="-1" onclick="logout()">Logout</a>
                                        </form>
                                </li>
                            </ul>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link waves-effect">Log in</a>
                    </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link waves-effect">Register</a>
                        </li>
                        @endif
                    @endauth

            </ul>

        </div>

    </div>
</nav>
<!-- Navbar -->

<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade pt-4" data-ride="carousel">

    <!--Indicators-->
    <ol class="carousel-indicators">
        <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-1z" data-slide-to="1"></li>
        <li data-target="#carousel-example-1z" data-slide-to="2"></li>
    </ol>
    <!--/.Indicators-->

    <!--Slides-->
    <div class="carousel-inner" role="listbox">

        <!--First slide-->
        <div class="carousel-item active">
            <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%282%29.jpg'); background-repeat: no-repeat; background-size: cover;">

                <!-- Mask & flexbox options-->
                <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                    <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <h1 class="mb-4">
                            <strong>E-clothing</strong>
                        </h1>

                        <p>
                            <strong>Buy highest quality with lowest price.</strong>
                        </p>
                    </div>
                    <!-- Content -->

                </div>
                <!-- Mask & flexbox options-->

            </div>
        </div>
        <!--/First slide-->

        <!--Second slide-->
        <div class="carousel-item">
            <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%283%29.jpg'); background-repeat: no-repeat; background-size: cover;">

                <!-- Mask & flexbox options-->
                <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                    <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <h1 class="mb-4">
                            <strong>E-clothing</strong>
                        </h1>

                        <p>
                            <strong>Buy highest quality with lowest price.</strong>
                        </p>
                    </div>
                    <!-- Content -->

                </div>
                <!-- Mask & flexbox options-->

            </div>
        </div>
        <!--/Second slide-->

        <!--Third slide-->
        <div class="carousel-item">
            <div class="view" style="background-image: url('https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/8-col/img%285%29.jpg'); background-repeat: no-repeat; background-size: cover;">

                <!-- Mask & flexbox options-->
                <div class="mask rgba-black-strong d-flex justify-content-center align-items-center">

                    <!-- Content -->
                    <div class="text-center white-text mx-5 wow fadeIn">
                        <h1 class="mb-4">
                            <strong>E-clothing</strong>
                        </h1>

                        <p>
                            <strong>Buy highest quality with lowest price.</strong>
                        </p>
                    </div>
                    <!-- Content -->

                </div>
                <!-- Mask & flexbox options-->

            </div>
        </div>
        <!--/Third slide-->

    </div>
    <!--/.Slides-->

    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->

</div>
<!--/.Carousel Wrapper-->

<!--Main layout-->
<main>
    <div class="container">

        <!--Navbar-->
        <nav style="background-color: #2196f3 !important;" class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mt-3 {{ $subCategories != null ? 'mb-2' : 'mb-5'}} ">

            <!-- Navbar brand -->
            <span class="navbar-brand">Categories:</span>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">

                <!-- Links -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item {{ $currentCategory == 'all' ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home',['category'=> null, 'subCategory' => null]) }}">All</a>
                    </li>
                    @foreach($categories as $category)
                    <li class="nav-item {{ $category->id == $currentCategory ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home',['category'=>$category->id, 'subCategory' => null]) }}">{{ $category->name }}</a>
                    </li>
                    @endforeach
                </ul>
                <!-- Links -->

                <form action="{{ route('showSearchProduct') }}" method="POST" class="form-inline">
                    @csrf
                    <div class="md-form my-0">
                        <input type="hidden" name="category" value="{{ $currentCategory }}">
                        <input type="hidden" name="subCategory" value="{{ $currentSubCategory }}">
                        <input name="search" class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    </div>
                </form>
            </div>
            <!-- Collapsible content -->
        </nav>
        <!--/.Navbar-->

        <!--Sub Navbar-->
        @if($subCategories != null && !$subCategories->isEmpty())
        <nav style="background-color: #2196f3 !important;" class="navbar navbar-expand-lg navbar-dark mdb-color lighten-3 mb-5">

            <!-- Navbar brand -->
            <span class="navbar-brand">Sub Categories:</span>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
                    aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapsible content -->
            <div class="collapse navbar-collapse" id="basicExampleNav">

                <!-- Links -->
                <ul class="navbar-nav mr-auto">
                    @foreach($subCategories as $subCategory)
                        <li class="nav-item {{ $subCategory->id == $currentSubCategory ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('home',['category' => $subCategory->category->id, 'subCategory' => $subCategory->id]) }}">{{ $subCategory->name }}</a>
                        </li>
                    @endforeach
                </ul>
                <!-- Links -->
            </div>
            <!-- Collapsible content -->
        </nav>
        @endif
        <!--/.Navbar-->

        <!--Section: Products v.3-->
        <section class="text-center mb-4">
            <div class="row wow fadeIn">
            @if($products->total() !== 0)
                @foreach($products as $product)
                    <!--Grid column-->
                    <div class="col-lg-3 col-md-6 mb-4">

                            <!--Card-->
                            <div class="card" style="width: 100%;height: 400px;object-fit: cover;">

                                <!--Card image-->
                                <div class="view overlay">
                                    <img class="img-fluid" src="{{ asset('storage/'.$product->images()->first()->path)}}"
                                         alt="{{ $product->title }}">
                                    <a href="{{ route('showProduct', ['product' => $product->id]) }}">
                                        <div class="mask rgba-white-slight"></div>
                                    </a>
                                </div>
                                <!--Card image-->

                                <!--Card content-->
                                <div class="card-body text-center">
                                    <!--Category & Title-->
                                    <a href="{{ route('showProduct', ['product' => $product->id]) }}" class="grey-text">
                                        <h5>{{ $product->category->name }}</h5>
                                    </a>
                                    <h5>
                                        <strong>
                                            <a href="{{ route('showProduct', ['product' => $product->id]) }}" class="dark-grey-text">{{ $product->title }}</a>
                                        </strong>
                                    </h5>

                                    <h4 class="font-weight-bold blue-text">
                                        <strong>{{ $product->discount_price }}$</strong>
                                    </h4>

                                </div>
                                <!--Card content-->

                            </div>
                            <!--Card-->

                        </div>
                    <!--Grid column-->
                @endforeach
                @else
                    <h6 class="center">No Product.</h6>
                @endif
            </div>
        </section>

        <div class="d-flex justify-content-center">
            {!! $products->links() !!}
        </div>
        <!--Section: Products v.3-->
    </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <!--Copyright-->
    <div class="footer-copyright py-3">

        <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank">  </a>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->

<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="{{ asset('e-commerce/js/jquery-3.4.1.min.js') }}"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="{{ asset('e-commerce/js/popper.min.js') }}"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="{{ asset('e-commerce/js/bootstrap.min.js') }}"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="{{ asset('e-commerce/js/mdb.min.js') }}"></script>
{!! Html::script('assets/js/toastr.min.js') !!}
<!-- Initializations -->
<script type="text/javascript">
    // Animations initialization
    new WOW().init();
    function logout() {
        $('#logout-form').submit();
    }

</script>
<script>
    toastr.options.progressBar = true;
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error('{{ $error }}');
    @endforeach
    @endif

    @if(session()->has('message'))
    let type = '{{ session()->get('alert-type', 'info') }}';
    switch (type) {
        case 'info':
            toastr.info("{{ session()->get('message') }}");
            break;
        case 'success':
            toastr.success("{{ session()->get('message') }}");
            break;
        case 'error':
            toastr.error("{{ session()->get('message') }}");
            break;
        case 'warning':
            toastr.warning("{{ session()->get('message') }}");
            break;
    }
    @endif
</script>
</body>

</html>
