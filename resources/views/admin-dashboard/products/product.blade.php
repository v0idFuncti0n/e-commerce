@extends('admin-dashboard.layout.master')

@section('our-styles')
    <style>
        td img {
            width: 108px !important;
            height: 108px !important;
            border-radius: 0 !important;
        }
    </style>
@endsection

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Products
                    <a href="{{ route('admin.products.create') }}">
                        <button type="button" class="btn btn-primary btn-fw float-right">Add Product</button>
                    </a>
                </h4>
                <p class="card-description"></p>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th> Id</th>
                            <th> Thumbnail</th>
                            <th> Title</th>
                            <th> Quantity</th>
                            <th> Selling Price</th>
                            <th> Status</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    {{ $product->id }}
                                </td>
                                <td>
                                    <img src="{{ asset($product->images->where('is_thumbnail', 1)->first()->path) }}"
                                         alt="{{ $product->name }}">
                                </td>
                                <td>
                                    {{ $product->title }}
                                </td>
                                <td>
                                    {{ $product->quantity }}
                                </td>
                                <td>
                                    {{ $product->selling_price }}
                                </td>
                                <td>
                                    {{ $product->status }}
                                </td>
                                <td>
                                    <a href=""><button type="button" class="btn btn-warning">Edit</button></a>
                                    <button type="button" class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
