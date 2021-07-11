@extends('admin-dashboard.layout.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-description"></p>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Date</th>
                            <th>Payment</th>
                            <th>Order</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{\Carbon\Carbon::parse($order->created_at)->format('Y-m-d H:i')}}</td>
                                <td>Stripe</td>
                                <td><span class="badge {{$order->shipped ? 'badge-success' : 'badge-secondary'}}">{{$order->shipped ? 'Shipped' : 'Pending'}}</span></td>
                                <td>{{$order->total}}$</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.orders.items',['id' => $order->id]) }}"><i class="fas fa-eye"></i> View</a>
                                    <form style="display : inline;" action="{{ route('admin.orders.ship',['id' => $order->id]) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-download"></i> Ship</button>
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


