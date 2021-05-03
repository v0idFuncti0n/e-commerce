@extends('admin-dashboard.layout.master')

@section('content')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Categories
                    <button type="button" class="btn btn-primary btn-fw float-right" data-toggle="modal"
                            data-target="#add-sub-category-modal">New Sub Category
                    </button>
                </h4>
                <p class="card-description"></p>
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                        <tr>
                            <th> Id</th>
                            <th> Sub Category Name</th>
                            <th> Category Name</th>
                            <th> Created At</th>
                            <th> Updated At</th>
                            <th> Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sub_categories as $sub_category)
                            <tr>
                                <td>
                                    {{ $sub_category->id }}
                                </td>
                                <td>
                                    {{ $sub_category->name }}
                                </td>
                                <td>
                                    {{ $sub_category->category->name }}
                                </td>
                                <td>
                                    {{ $sub_category->created_at }}
                                </td>
                                <td>
                                    {{ $sub_category->updated_at }}
                                </td>
                                <td class="dt">
                                    <button type="button" class="btn btn-warning btn-fw btn-edit" data-toggle="modal"
                                            data-target="#edit-sub-category-modal"
                                            data-category_id="{{ $sub_category->category->id }}"
                                            data-sub_category_id="{{ $sub_category->id }}"
                                            data-sub_category_name="{{ $sub_category->name }}">Edit
                                    </button>
                                    <form style="display : inline;"
                                          action="{{ route('admin.subCategories.delete', ['id' => $sub_category->id]) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger btn-fw btn-delete">Delete</button>
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

    {{--new sub category modal--}}
    <div id="add-sub-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Sub Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="add-submit-form" action="{{ route("admin.subCategories.store") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_name">Sub Category Name :</label>
                            <input type="text" class="form-control" name="sub_category_name"
                                   placeholder="Fiction Books">
                        </div>
                        <div class="form-group">
                            <label for="select_category_id">Parent Category</label>
                            <select class="form-control" style="height: 3rem !important"
                                    name="category_id" id="select_category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="add-submit-button" type="button" class="btn btn-primary">Add Sub Category</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{--edit sub category modal--}}
    <div id="edit-sub-category-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-submit-form" action="{{ route('admin.subCategories.update', ['id' => ':id']) }}"
                          method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="sub_category_name">Sub Category Name :</label>
                            <input type="text" class="form-control" name="sub_category_name"
                                   placeholder="Fiction Books">
                        </div>
                        <div class="form-group">
                            <label for="edit_select_category_id">Parent Category</label>
                            <select class="form-control" style="height: 3rem !important"
                                    name="category_id" id="edit_select_category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="edit-submit-button" type="button" class="btn btn-warning">Edit Sub Category</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
