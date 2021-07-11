<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Material Design Bootstrap</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('e-commerce/css/bootstrap.min.css') }}" rel="stylesheet">
    Material Design Bootstrap
    <link href="{{ asset('e-commerce/css/mdb.min.css') }}" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="{{ asset('e-commerce/css/style.min.css') }}" rel="stylesheet">
    {!! Html::style('/css/toastr.css') !!}
</head>

<body>

<!-- Navbar -->
<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand waves-effect">
            <strong class="blue-text">Ecommerce</strong>
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
                <li class="nav-item">
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
                            <img class="mx-auto rounded-circle" style="height: 20%; width:20%"
                                 src="{{ Auth::user()->profile_photo_url }}">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            @role('admin')
                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                       href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                            @endrole
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('show.orders')}}">My
                                    Orders</a></li>
                            </li>
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

<!--Main layout-->
<main class="mt-5 pt-4" style="margin-bottom: 8rem">
    <div class="container dark-grey-text mt-5">
        <h1 class="ml-5 mb-5">{{$product->title}}</h1>
        <!--Grid row-->
        <div class="row wow fadeIn">

            <!--Grid column-->
            <div class="col-md-6 mb-4">
                <div>
                    <img id="main-image" style="width: 100%;height: 25vw;object-fit: cover;"
                         src="{{ asset('storage/'.$product->images()->first()->path)}}" class="img-fluid" alt="">
                </div>
                <div class="mt-5">
                    @foreach($product->images as $image)
                        <img class="ml-2 mr-2" style="width: 40px;height: 40px;border: 1px solid black;"
                             src="{{asset('storage/'.$image->path)}}" alt="" onclick="setMainImage(this.src)">
                    @endforeach
                </div>
            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-6 mb-4">

                <!--Content-->
                <div class="p-4">

                    {{--<div class="mb-3">
                        <a href="">
                            <span class="badge purple mr-1">Category 2</span>
                        </a>
                        <a href="">
                            <span class="badge blue mr-1">New</span>
                        </a>
                        <a href="">
                            <span class="badge red mr-1">Bestseller</span>
                        </a>
                    </div>--}}

                    <p class="lead">
              <span class="mr-1">
                <del>{{ $product->selling_price }}$</del>
              </span>
                        <span>{{ $product->discount_price }}$</span>
                    </p>

                    <p class="lead font-weight-bold">Description</p>

                    <p>{!! $product->description !!}</p>

                    <form class="d-flex justify-content-left form-group">
                        <!-- Default input -->
                        <div class="form-group mb-2">
                            <label for="quantity">Quantity :</label>
                            <input id="quantity" type="number" value="1" aria-label="Search" class="form-control"
                                   style="width: 100px" min="1" max="{{ $product->quantity }}">
                        </div>
                        <div class="form-group ml-3">
                            <label for="color">Color :</label>
                            <select class="form-control" id="color" name="color">
                                @foreach(explode(',', $product->color) as $color)
                                    <option value="{{$color}}">{{$color}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group ml-3">
                            <label for="size">Size :</label>
                            <select class="form-control" id="size" name="size">
                                @foreach(explode(',', $product->size) as $size)
                                    <option value="{{$size}}">{{$size}}</option>
                                @endforeach
                            </select>
                        </div>

                    </form>
                    <button class="btn btn-primary btn-md my-0 p" type="button" onclick="addToCart()">Add to
                        cart
                        <i class="fas fa-shopping-cart ml-1"></i>
                    </button>

                </div>
                <!--Content-->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small mt-5 wow fadeIn">


    <hr class="my-5">

    <!--Copyright-->
    <div class="footer-copyright py-3">
        © 2019 Copyright:
        <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
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
<!-- Initializations -->
{!! Html::script('assets/js/toastr.min.js') !!}

<script type="text/javascript">
    // Animations initialization
    new WOW().init();
    toastr.options.progressBar = true;

    function addToCart() {
        let product_id = {{ $product->id }};
        let quantity = $('#quantity').val();
        let color = $('#color').val();
        let size = $('#size').val();

        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                product_id: product_id,
                quantity: quantity,
                color: color,
                size: size
            },
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: "/cart/data/store/" + product_id,
            success: function (data) {
                $('#cart-count').text(data.cartItems);
                toastr.success('Item has been added to cart');
            },
            error: function (data){
                toastr.error('There was an error try again later');
            }

        });
    }

    function logout() {
        $('#logout-form').submit();
    }

    function setMainImage(src){
        let main_image = $('#main-image');
        main_image.attr('src', src);
    }

</script>
</body>

</html>
