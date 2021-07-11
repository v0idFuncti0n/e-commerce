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
                            <th> Title</th>
                            <th> Thumbnail</th>
                            <th> Category</th>
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
                                    {{ $product->title }}
                                </td>
                                <td>
                                    <img
                                        src="{{ asset('/storage/'.$product->images->where('is_thumbnail', 1)->first()->path) }}"
                                        alt="{{ $product->name }}">
                                </td>
                                <td>
                                    {{ $product->category->name }}
                                </td>
                                <td>
                                    {{ $product->quantity }}
                                </td>
                                <td>
                                    {{ $product->selling_price }}
                                </td>
                                <td>
                                    @if($product->status == 1)
                                        @if($product->quantity > 0)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Out of stock</span>
                                        @endif
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <form style="display : inline;"
                                          action="{{ route('admin.products.edit', ['id' => $product->id]) }}"
                                          method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-fw">Edit</button>
                                    </form>
                                    <form style="display : inline;"
                                          action="{{ route('admin.products.delete', ['id' => $product->id]) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-fw btn-delete">Delete</button>
                                    </form>
                                    <form style="display : inline;" action="{{ route('admin.products.status', ['id' => $product->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-fw btn-secondary">{{ $product->status == 1 ? "Inactive" : "Active" }}</button>
                                    </form>
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
