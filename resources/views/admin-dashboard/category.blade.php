@extends('admin-dashboard.layout.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Categories
                    <button type="button" class="btn btn-primary btn-fw float-right" data-toggle="modal"
                            data-target="#new-category-modal">New Category
                    </button>
                </h4>

                <p class="card-description"></p>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th> User</th>
                            <th> First name</th>
                            <th> Progress</th>
                            <th> Amount</th>
                            <th> Deadline</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="py-1">
                                <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image"/></td>
                            <td> Herman Beck</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%"
                                         aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td> $ 77.99</td>
                            <td> May 15, 2015</td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <img src="{{ url('assets/images/faces-clipart/pic-2.png') }}" alt="image"/></td>
                            <td> Messsy Adam</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 75%"
                                         aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td> $245.30</td>
                            <td> July 1, 2015</td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <img src="{{ url('assets/images/faces-clipart/pic-3.png') }}" alt="image"/></td>
                            <td> John Richards</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 90%"
                                         aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td> $138.00</td>
                            <td> Apr 12, 2015</td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <img src="{{ url('assets/images/faces-clipart/pic-4.png') }}" alt="image"/></td>
                            <td> Peter Meggik</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 50%"
                                         aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td> $ 77.99</td>
                            <td> May 15, 2015</td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <img src="{{ url('assets/images/faces-clipart/pic-1.png') }}" alt="image"/></td>
                            <td> Edward</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 35%"
                                         aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td> $ 160.25</td>
                            <td> May 03, 2015</td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <img src="{{ url('assets/images/faces-clipart/pic-2.png') }}" alt="image"/></td>
                            <td> John Doe</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 65%"
                                         aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td> $ 123.21</td>
                            <td> April 05, 2015</td>
                        </tr>
                        <tr>
                            <td class="py-1">
                                <img src="{{ url('assets/images/faces-clipart/pic-3.png') }}" alt="image"/></td>
                            <td> Henry Tom</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 20%"
                                         aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </td>
                            <td> $ 150.00</td>
                            <td> June 16, 2015</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{--new category modal--}}

    <div id="new-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="submit-form" action="{{ route("admin.categories.store") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Category Name :</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Books">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="submit-button" type="button" class="btn btn-primary">Add Category</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

