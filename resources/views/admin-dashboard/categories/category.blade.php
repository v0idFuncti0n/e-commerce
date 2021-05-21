@extends('admin-dashboard.layout.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Categories
                    <button type="button" class="btn btn-primary btn-fw float-right" data-toggle="modal"
                            data-target="#add-category-modal">Add Category
                    </button>
                </h4>
                <p class="card-description"></p>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th> Id</th>
                            <th> Category Name</th>
                            <th> Created At</th>
                            <th> Updated At</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>
                                    {{ $category->id }}
                                </td>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td>
                                    {{ $category->created_at }}
                                </td>
                                <td>
                                    {{ $category->updated_at }}
                                </td>
                                <td class="dt">
                                    <button type="button" class="btn btn-warning btn-fw btn-edit" data-toggle="modal"
                                            data-target="#edit-category-modal"
                                            data-category_id="{{ $category->id }}"
                                            data-category_name="{{ $category->name }}">Edit
                                    </button>
                                    <form style="display : inline;"
                                          action="{{ route('admin.categories.delete', ['id' => $category->id]) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-fw btn-delete">Delete</button>
                                    </form>
                                    <form style="display : inline;"
                                          action="{{ route('admin.subCategories') }}"
                                          method="POST">
                                        @csrf
                                        <input type="hidden" name="search" value="{{ $category->name }}">
                                        <button type="submit" class="btn btn-primary btn-fw">Sub Categories</button>
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

    {{--new category modal--}}
    <div id="add-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-submit-form" action="{{ route("admin.categories.store") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Category Name :</label>
                            <input type="text" class="form-control" name="category_name"
                                   placeholder="Books">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="add-submit-button" type="button" class="btn btn-primary">Add Category</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{--edit category modal--}}
    <div id="edit-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-submit-form" action="{{ route('admin.categories.update', ['id' => ':id']) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="category_name">Category Name :</label>
                            <input type="text" class="form-control" name="category_name"
                                   placeholder="Books">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="edit-submit-button" type="button" class="btn btn-warning">Edit Category</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

