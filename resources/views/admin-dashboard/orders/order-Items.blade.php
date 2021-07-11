@extends('admin-dashboard.layout.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-description"></p>
                <div class="p-3 mb-2 bg-primary text-white">First Name: {{ $order->firstName }}</div>
                <div class="p-3 mb-2 bg-primary text-white">Last Name: {{ $order->lastName }}</div>
                <div class="p-3 mb-2 bg-primary text-white">Email: {{ $order->email }}</div>
                <div class="p-3 mb-2 bg-primary text-white">Phone: {{ $order->phone }}</div>
                <div class="p-3 mb-2 bg-primary text-white">Address: {{ $order->adress }}</div>
                <div class="p-3 mb-2 bg-primary text-white">Zip: {{ $order->zip }}</div>
                <div class="p-3 mb-2 bg-primary text-white">Total: <span style="color: black"><strong>{{ $order->total }}$</strong></span></div>
                <div class="p-3 mb-2 bg-primary text-white">Quantity: {{ $order->quantity }}</div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
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
            </div>
        </div>
    </div>

    {{--new coupon modal--}}
    <div id="add-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-submit-form" action="{{ route("admin.coupon.store") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Coupon code :</label>
                            <input type="text" class="form-control" name="coupon"
                                   placeholder="Coupon Code">
                        </div>
                        <div class="form-group">
                            <label for="category_name">Coupon discount (%):</label>
                            <input type="text" class="form-control" name="discount"
                                   placeholder="Coupon discount">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="add-submit-button" type="button" class="btn btn-primary">Add Coupon</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{--edit coupon modal--}}
    <div id="edit-coupon-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit This Coupon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-submit-form" action="{{ route('admin.coupon.update', ['id' => ':id']) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="coupon_name">Coupon Name :</label>
                            <input type="text" class="form-control" name="coupon"
                                   placeholder="Books">
                        </div>
                        <div class="form-group">
                            <label for="disc_name">New Percentage :</label>
                            <input type="text" class="form-control" name="discount"
                                   placeholder="%">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="edit-submit-button" type="button" class="btn btn-warning">Edit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection


