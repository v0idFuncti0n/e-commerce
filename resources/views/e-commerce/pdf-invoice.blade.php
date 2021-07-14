<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <!-- Bootstrap core CSS -->
    <style>
        table.darkTable {
            font-family: "Times New Roman", Times, serif;
            border: 1px solid #000000;
            width: 100%;
            height: auto;
            text-align: center;
            border-collapse: collapse;
        }
        table.darkTable td, table.darkTable th {
            border: 1px solid #4A4A4A;
            padding: 5px 5px;
        }
        table.darkTable tbody td {
            font-size: 20px;
        }
        table.darkTable thead {
            background: #272727;
            border-bottom: 3px solid #000000;
        }
        table.darkTable thead th {
            font-size: 25px;
            font-weight: bold;
            color: #E6E6E6;
            text-align: center;
            border-left: 2px solid #4A4A4A;
        }
        table.darkTable thead th:first-child {
            border-left: none;
        }

        table.darkTable tfoot td {
            font-size: 12px;
        }

    </style>
</head>
<body>
<h1>E-clothing</h1>
<h2><u>INVOICE</u></h2>

<table style="margin-bottom: 5rem" class="darkTable">
    <thead>
    <tr>
        <th>BILL TO</th>
        <th>SHIP TO</th>
        <th>ORDER NO#</th>
        <th>DATE</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>{{ $order->firstName.' '.$order->lastName }}</td>
        <td>
            {{ $order->address }}<br>
            {{ $order->phone }}<br>
            {{ $order->zip }}
        </td>
        <td>{{ $order->id }}</td>
        <td>{{ $order->created_at->format('jS F y')}}</td>
    </tr>
    </tbody>
</table>


<table class="darkTable">
    <thead>
    <tr>
        <th>QTY</th>
        <th>TITLE</th>
        <th>COLOR</th>
        <th>SIZE</th>
        <th>UNIT PRICE</th>
        <th>AMOUNT</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->orderItems as $orderItem)
        <tr>
            <td>{{ $orderItem->quantity }}</td>
            <td>{{ \App\Models\Product::find($orderItem->product_id)->title }}</td>
            <td>{{ $orderItem->color }}</td>
            <td>{{ $orderItem->size }}</td>
            <td>{{ \App\Models\Product::find($orderItem->product_id)->discount_price }}$</td>
            <td>{{ $orderItem->price }}$</td>
        </tr>
    @endforeach
    </tbody>
</table>

<span><h3>REDUCED AMOUNT :   <strong>{{ $order->total - $order->orderItems->sum('price')}}$</strong></h3></span>
<span><h3>TOTAL :   <strong>{{ $order->total }}$</strong></h3></span>
</body>
</html>
