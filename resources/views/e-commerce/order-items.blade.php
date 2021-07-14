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
    {!! Html::style('/css/datatables.css') !!}
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
                            <img class="mx-auto rounded-circle" style="width: 2rem;height: 2rem"
                                 src="{{ Auth::user()->profile_photo_url }}">
                            {{ Auth::user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            @role('admin')
                            <li role="presentation"><a role="menuitem" tabindex="-1"
                                                       href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                            @endrole
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('profile.show')}}">Edit Profile</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="{{route('show.orders')}}">My Orders</a></li>
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
<main class="mt-5 pt-4">
    <div class="container dark-grey-text mt-5">
        <h1 class="mb-5">Order Details:</h1>
        <div class="p-3 mb-2 bg-info text-white">First Name: {{ $order->firstName }}</div>
        <div class="p-3 mb-2 bg-info text-white">Last Name: {{ $order->lastName }}</div>
        <div class="p-3 mb-2 bg-info text-white">Email: {{ $order->email }}</div>
        <div class="p-3 mb-2 bg-info text-white">Phone: {{ $order->phone }}</div>
        <div class="p-3 mb-2 bg-info text-white">Address: {{ $order->address }}</div>
        <div class="p-3 mb-2 bg-info text-white">Zip: {{ $order->zip }}</div>
        <div class="p-3 mb-2 bg-info text-white">Total: <span style="color: black"><strong>{{ $order->total }}$</strong></span></div>
        <div class="p-3 mb-2 bg-info text-white">Quantity: {{ $order->quantity }}</div>

        <table id="orders" class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Product Id</th>
                <th>Product Color</th>
                <th>Product Size</th>
                <th>Product Quantity</th>
                <th>Product Price</th>
            </tr>
            </thead>
            <tbody>
                @foreach($orderItems as $orderItem)
                    <tr>
                        <td>{{ $orderItem->id }}</td>
                        <td><img style="width: 200px;height: 200px" src="{{ '/storage/'.App\Models\Product::find($orderItem->product_id)->images()->first()->path }}" alt="{{ App\Models\Product::find($orderItem->product_id)->name }}"></td>
                        <td>{{ App\Models\Product::find($orderItem->product_id)->title }}</td>
                        <td>{{ App\Models\Product::find($orderItem->product_id)->id }}</td>
                        <td>{{ $orderItem->color }}</td>
                        <td>{{ $orderItem->size }}</td>
                        <td>{{ $orderItem->quantity }}</td>
                        <td>{{ $orderItem->price }}$</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small mt-4 wow fadeIn">

    <hr class="my-4">

    <!--Copyright-->
    <div class="footer-copyright py-3">

        <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> </a>
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
<script type="text/javascript" src="{{ asset('assets/js/datatables.js') }}"></script>
<!-- Initializations -->
<script type="text/javascript">
    // Animations initialization
    new WOW().init();
    $(document).ready(function () {
        $('#orders').DataTable({
            "order": [[ 1, "desc" ]]
        });
    });

    function logout() {
        $('#logout-form').submit();
    }
</script>
</body>

</html>
