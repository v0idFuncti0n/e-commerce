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
    <style>
        /**
       * The CSS shown here will not be introduced in the Quickstart guide, but shows
       * how you can use CSS to style your Element's container.
       */
        .StripeElement {
            box-sizing: border-box;

            height: 40px;
            width: 100%;

            padding: 10px 12px;

            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;

            box-shadow: 0 1px 3px 0 #e6ebf1;
            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

    </style>
</head>

<body class="grey lighten-3">

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
<main class="mt-5 pt-4">
    <div class="container wow fadeIn">

        <!-- Heading -->
        <h2 class="my-5 h2 text-center">Checkout form</h2>

        <!--Grid row-->
        <div class="row">

            <!--Grid column-->
            <div class="col-md-8 mb-4">

                <!--Card-->
                <div class="card">

                    <!--Card content-->
                    <form id="payment-form" class="card-body" action="{{ route('stripe.order') }}" method="POST">
                    @csrf
                    <!--Grid row-->
                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6 mb-2">

                                <!--firstName-->
                                <div class="md-form ">
                                    <input type="text" id="firstName" class="form-control" name="firstName" required>
                                    <label for="firstName" class="">First name</label>
                                </div>

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6 mb-2">

                                <!--lastName-->
                                <div class="md-form">
                                    <input type="text" id="lastName" class="form-control" name="lastName" required>
                                    <label for="lastName" class="">Last name</label>
                                </div>

                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <!--email-->
                        <div class="md-form mb-5">
                            <input type="text" id="email" name="email" class="form-control"
                                   placeholder="youremail@example.com"
                                   value="{{ \Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email : "" }}"
                                   required>
                            <label for="email" class="">Email (optional)</label>
                        </div>

                        <!--address-->
                        <div class="md-form mb-2">
                            <input type="text" id="address" class="form-control" placeholder="1234 Main St"
                                   name="address" required>
                            <label for="address" class="">Address</label>
                        </div>

                        <div class="row">

                            <!--Grid column-->
                            <div class="col-md-6 mb-2">

                                <!--firstName-->
                                <div class="md-form ">
                                    <input type="tel" id="phone" class="form-control" name="phone" required>
                                    <label for="phone" class="">Phone</label>
                                </div>

                            </div>
                            <!--Grid column-->

                            <!--Grid column-->
                            <div class="col-md-6 mb-2">

                                <!--lastName-->
                                <div class="md-form">
                                    <input type="tel" id="zip" class="form-control" name="zip" required>
                                    <label for="zip" class="">Zip Code</label>
                                </div>

                            </div>
                            <!--Grid column-->

                        </div>
                        <!--Grid row-->

                        <hr>

                        <div class="form-row">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display Element errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout</button>
                    </form>

                </div>
                <!--/.Card-->

            </div>
            <!--Grid column-->

            <!--Grid column-->
            <div class="col-md-4 mb-4">

                <!-- Heading -->
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span id="span_count_2" class="badge badge-secondary badge-pill">{{ Cart::count() }}</span>
                </h4>

                <!-- Cart -->
                <ul class="list-group mb-3 z-depth-1">
                    @foreach($cartProducts as $product)
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0">{{ $product->name }}</h6>

                                <span style="cursor: pointer;margin: 0 0;" class="badge badge-danger"
                                        data-row_id="{{$product->rowId}}"
                                        data-product_id="{{ $product->id }}" type="button"
                                        onclick="decrementItem(event)"
                                ><i class="fas fa-minus"></i></span>

                                <span id="{{$product->rowId}}" class="badge badge-primary">{{ $product->qty }}</span>

                                <span style="cursor: pointer;" class="badge badge-success"
                                      type="button"
                                      data-row_id="{{$product->rowId}}"
                                      data-product_id="{{ $product->id }}"
                                      onclick="incrementItem(event)"
                                ><i class="fas fa-plus"></i></span>

                                <span style="cursor: pointer;float: right" class="badge badge-danger"
                                      type="button"
                                      data-row_id="{{$product->rowId}}"
                                      data-product_id="{{ $product->id }}"
                                      onclick="removeItem(event)"><i class="fa fa-trash"
                                                                aria-hidden="true"></i></span>
                            </div>
                            <span class="text-muted">{{ $product->price }}$</span>
                        </li>
                    @endforeach
                    @if(Session::has('coupon'))
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>{{session()->get('coupon')['coupon']}}</small>
                            </div>
                            <span class="text-success">-{{session()->get('coupon')['discount']}}%</span>
                        </li>
                    @endif
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong
                            id="total">{{ Session::has('coupon') ? Cart::total() - (Cart::total() * session()->get('coupon')['discount'] / 100) : Cart::total() }}
                            $</strong>
                    </li>
                </ul>
                <!-- Cart -->

                <!-- Promo code -->
                <form class="card p-2">
                    <div class="input-group">
                        <input id="coupon" type="text" class="form-control" placeholder="Promo code"
                               aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-secondary btn-md waves-effect m-0" type="button"
                                    onclick="applyCoupon()">Redeem
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Promo code -->

            </div>
            <!--Grid column-->

        </div>
        <!--Grid row-->

    </div>
</main>
<!--Main layout-->

<!--Footer-->
<footer class="page-footer text-center font-small mt-4 wow fadeIn">
    <hr class="my-4">
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
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    // Animations initialization
    new WOW().init();
    var stripe = Stripe(
        'pk_test_51J6zCZDG2r86Ky5V5h9bMA7QrCjYkvQsNLLjGRr1u580wnQg7Zs6VeUkKVsh5K4HBK4ht6IuMgHOwLaGsalcxWaw00dI6jRtGA'
    );

    var elements = stripe.elements();
    var style = {
        base: {
            // Add your base input styles here. For example:
            fontSize: '16px',
            color: '#32325d',
        },
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    let form = $('#payment-form');
    form.on('submit', function (event) {
        event.preventDefault();

        stripe.createToken(card).then(function (result) {
            if (result.error) {
                // Inform the customer that there was an error.
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form

        form.submit();
    }

    function removeItem(event) {
        let button = $(event.currentTarget);
        let rowId = button.data('row_id');
        let productId = button.data('product_id');

        $.ajax({
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: "/cart/data/remove/" + rowId + "/" + productId,
            success: function (data) {
                location.reload();
                //$('#cart-count').text(data.cartItems);
            }
        });

    }

    function logout() {
        $('#logout-form').submit();
    }

    function applyCoupon() {
        let coupon = $('#coupon').val();
        $.ajax({
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
            data: {
                'coupon': coupon
            },
            url: "/product/apply-coupon",
            success: function (data) {
                console.log(data);
                location.reload();
            },
            error: function (data) {
                console.log(data);
            }
        });
    }

    function incrementItem(event) {
        let button = $(event.currentTarget);
        let rowId = button.data('row_id');
        let productId = button.data('product_id');
        let span_count = $('#cart-count');
        let span_count_2 = $('#span_count_2');
        let span_quantity = $("#"+rowId);
        let total = $('#total');

        $.ajax({
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: "/cart/incrementItem/" + rowId + "/" + productId,
            success: function (data) {
                //location.reload();
                span_count.text(data.count);
                span_count_2.text(data.count);
                span_quantity.text(data.qty);
                total.text(data.total + "$");
            },
            error: function (data) {
                //console.log(data);
            }
        });
    }

    function decrementItem(event) {
        let button = $(event.currentTarget);
        let rowId = button.data('row_id');
        let productId = button.data('product_id');
        let span_count = $('#cart-count');
        let span_count_2 = $('#span_count_2');
        let span_quantity = $("#"+rowId);
        let total = $('#total');

        $.ajax({
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            url: "/cart/decrementItem/" + rowId + "/" + productId,
            success: function (data) {
                //location.reload();
                span_count.text(data.count);
                span_count_2.text(data.count);
                span_quantity.text(data.qty);
                total.text(data.total + "$");
            },
            error: function (data) {
                //console.log(data);
            }
        });
    }


</script>

</body>

</html>
