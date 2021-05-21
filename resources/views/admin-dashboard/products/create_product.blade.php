@extends('admin-dashboard.layout.master')

@section('our-styles')
    <style type="text/css">
        /* fix multi tag css */
        .bootstrap-tagsinput {
            width: 100%;
        }

        .label-info {
            background-color: #17a2b8;
        }

        .label {
            display: inline-block;
            padding: .25em .4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1.5;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: .25rem;
            transition: color .15s ease-in-out, background-color .15s ease-in-out,
            border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <h3>Add Product</h3>
            <form id="product-form">
                @csrf
                <div class="form-group">
                    <label for="title" class="col-sm-2 col-form-label col-form-label-lg">Title</label>
                    <input type="text" class="form-control form-control-lg" id="title" name="title">
                </div>
                <label for="editor" class="col-sm-2 col-form-label col-form-label-lg">Description</label>
                <div class="form-group" id="editor" style="min-height: 200px">
                </div>
                <label for="description" style="display: none"></label>
                <input type="text" name="description" id="description" style="display: none">
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="code" class="col-sm-4 col-form-label col-form-label-lg">Code</label>
                        <input type="text" class="form-control form-control-lg" id="code" name="code">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="quantity" class="col-sm-4 col-form-label col-form-label-lg">Qte</label>
                        <input type="number" class="form-control form-control-lg" id="quantity" name="quantity" min="1">
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="brand" class="col-sm-4 col-form-label col-form-label-lg">Brand</label>
                        <input type="text" class="form-control form-control-lg" id="brand" name="brand">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="category" class="col-sm-6 col-form-label col-form-label-lg">Category</label>
                        <select class="form-control form-control-lg" id="category" name="category">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="sub_category" class="col-sm-6 col-form-label col-form-label-lg">Sub Category</label>
                        <select class="form-control form-control-lg" id="sub_category" name="sub_category">
                            @foreach($sub_categories as $sub_category)
                                <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="color" class="col-sm-6 col-form-label col-form-label-lg">Colors</label>
                        <input type="text" class="form-control form-control-lg" data-role="tagsinput" id="color"
                               name="color">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="size" class="col-sm-6 col-form-label col-form-label-lg">Sizes</label>
                        <input type="text" class="form-control form-control-lg" data-role="tagsinput" id="size"
                               name="size">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="selling_price" class="col-sm-6 col-form-label col-form-label-lg">Selling
                            Price</label>
                        <input type="text" class="form-control form-control-lg" id="selling_price" name="selling_price">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="discount_price" class="col-sm-6 col-form-label col-form-label-lg">Discount
                            Price</label>
                        <input type="text" class="form-control form-control-lg" id="discount_price"
                               name="discount_price">
                    </div>
                </div>
                <div class="from-row">
                    <label for="selling_price" class="col-sm-4 col-form-label col-form-label-lg">Images</label>
                    <div id="drag-drop-area"></div>
                </div>
                <br>
                <div class="from-row">
                    <label for="video_link">Video Link</label>
                    <input class="form-control form-control-lg" type="url" name="video_link" id="video_link">
                </div>
                <br>
                <button class="btn btn-primary btn-lg btn-block" type="submit" id="btn-submit">Add Product</button>
            </form>

        </div>
    </div>
@endsection

@section('our-scripts')
    <script>
        let descriptionInput = $('#description');

        // Quill js
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{'header': 1}, {'header': 2}],               // custom button values
            [{'list': 'ordered'}, {'list': 'bullet'}],
            [{'script': 'sub'}, {'script': 'super'}],      // superscript/subscript
            [{'indent': '-1'}, {'indent': '+1'}],          // outdent/indent
            [{'direction': 'rtl'}],                         // text direction

            [{'size': ['small', false, 'large', 'huge']}],  // custom dropdown
            [{'header': [1, 2, 3, 4, 5, 6, false]}],

            [{'color': []}, {'background': []}],          // dropdown with defaults from theme
            [{'font': []}],
            [{'align': []}],

            ['clean']                                         // remove formatting button
        ];
        var options = {
            debug: false,
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'
        };
        var editor = new Quill('#editor', options);

        editor.on('text-change', function () {
            descriptionInput.val(editor.root.innerHTML);
        });

        // Uppy
        const uppy = Uppy.Core({
            debug: true,
            autoProceed: false,
            restrictions: {
                maxFileSize: 1000000,
                maxNumberOfFiles: 4,
                minNumberOfFiles: 1,
                allowedFileTypes: ['image/*']
            }
        });

        uppy.use(Uppy.Dashboard, {
            inline: true,
            target: '#drag-drop-area',
            width: '100%',
            hideUploadButton: true
        });

        uppy.use(Uppy.XHRUpload, {
            endpoint: '{{ route('admin.products.store') }}',
            headers: {
                'X-CSRF-Token': " {{ csrf_token() }} "
            },
            method: 'post',
            formData: true,
            fieldName: 'files[]',
            bundle: true
        });

        uppy.use(Uppy.Form, {
            target: document.querySelector("#product-form"),
            resultName: "uppyResult",
            getMetaFromForm: true,
            addResultToForm: true,
            multipleResults: true,
            submitOnSuccess: true,
            triggerUploadOnSubmit: true,
        })
        uppy.on('complete', () => {
            window.location.replace('{{ route('admin.products.create') }}');
        });

        let subCategoriesSelect = $('#sub_category');

        function getSubCategories(categoryId) {
            $.ajax({
                type: 'POST',
                "_token": "{{ csrf_token() }}",
                url: '/admin/categories/get-sub-categories/' + categoryId,
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function (data) {
                    subCategoriesSelect.empty();
                    data.subCategories.forEach(function(subCategory){
                        subCategoriesSelect.append(new Option(subCategory.name, subCategory.id));
                    });

                }
            });
        }


        $('#category').on('change', function () {
            let category_id = $(this).val();
            getSubCategories(category_id);
        });

    </script>
@endsection
