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
                    <label for="id" style="display: none"></label>
                    <input type="text" name="id" id="id" style="display: none"
                           value="{{ $product->id }}">
                </div>
                <div class="form-group">
                    <label for="title" class="col-sm-2 col-form-label col-form-label-lg">Title</label>
                    <input type="text" class="form-control form-control-lg" id="title" name="title"
                           value="{{ $product->title }}">
                    <div id="titleError" class="col-sm-3" style="display: none">
                        <small class="text-danger">
                            Title is required and should be less than 255 characters.
                        </small>
                    </div>
                </div>
                <label for="editor" class="col-sm-2 col-form-label col-form-label-lg">Description</label>
                <div class="form-group" id="editor" style="min-height: 200px">
                </div>
                <div id="editorError" class="col-sm-6" style="display: none">
                    <small class="text-danger">
                        Description should not be empty.
                    </small>
                </div>
                <label for="description" style="display: none"></label>
                <input type="text" name="description" id="description" style="display: none"
                       value="{{ $product->description }}">
                <div class="form-row">
                    <div class="form-group col-sm-4">
                        <label for="code" class="col-sm-4 col-form-label col-form-label-lg">Code</label>
                        <input type="text" class="form-control form-control-lg" id="code" name="code"
                               value="{{ $product->code }}">
                        <div id="codeError" style="display: none">
                            <small class="text-danger">
                                Code is required and should be less than 255 characters.
                            </small>
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="quantity" class="col-sm-4 col-form-label col-form-label-lg">Qte</label>
                        <input type="number" class="form-control form-control-lg" id="quantity" name="quantity" min="1"
                               value="{{ $product->quantity }}">
                        <div id="quantityError" style="display: none">
                            <small class="text-danger">
                                Quantity is required.
                            </small>
                        </div>
                    </div>
                    <div class="form-group col-sm-4">
                        <label for="brand" class="col-sm-4 col-form-label col-form-label-lg">Brand</label>
                        <input type="text" class="form-control form-control-lg" id="brand" name="brand"
                               value="{{ $product->brand }}">
                        <div id="brandError" style="display: none">
                            <small class="text-danger">
                                Brand is required and should be less than 255 characters.
                            </small>
                        </div>
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
                               name="color" value="{{ $product->color }}">
                        <div id="colorError" style="display: none">
                            <small class="text-danger">
                                At least on color is required and should be less than 255 characters.
                            </small>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="size" class="col-sm-6 col-form-label col-form-label-lg">Sizes</label>
                        <input type="text" class="form-control form-control-lg" data-role="tagsinput" id="size"
                               name="size" value="{{ $product->size }}">
                        <div id="sizeError" style="display: none">
                            <small class="text-danger">
                                At lest one size is required and should be less than 255 characters.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm-6">
                        <label for="selling_price" class="col-sm-6 col-form-label col-form-label-lg">Selling
                            Price</label>
                        <input type="text" class="form-control form-control-lg" id="selling_price" name="selling_price"
                               value="{{ $product->selling_price }}">
                        <div id="selling_priceError" style="display: none">
                            <small class="text-danger">
                                Selling Price is required.
                            </small>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="discount_price" class="col-sm-6 col-form-label col-form-label-lg">Discount
                            Price</label>
                        <input type="text" class="form-control form-control-lg" id="discount_price"
                               name="discount_price" value="{{ $product->discount_price }}">
                        <div id="discount_priceError" style="display: none">
                            <small class="text-danger">
                                Discount Price is required.
                            </small>
                        </div>
                    </div>
                </div>
                <div class="from-row">
                    <label for="selling_price" class="col-sm-4 col-form-label col-form-label-lg">Images</label>
                    <div id="drag-drop-area"></div>
                </div>
                <br>
                <div class="from-row">
                    <label for="video_link">Video Link</label>
                    <input class="form-control form-control-lg" type="url" name="video_link" id="video_link"
                           value="{{ $product->video_link }}">
                    <div id="video_linkError" style="display: none">
                        <small class="text-danger">
                            Video Link is required and should be less than 255 characters.
                        </small>
                    </div>
                </div>
                <br>
                <button class="btn btn-warning btn-lg btn-block" type="button" id="btn-submit">Edit Product</button>
            </form>
        </div>
    </div>
@endsection

@section('our-scripts')
    <script>
        let title = $('#title');
        let description = $('#description');
        let code = $('#code');
        let quantity = $('#quantity');
        let brand = $('#brand');
        let color = $('#color');
        let size = $('#size');
        let sellingPrice = $('#selling_price');
        let discountPrice = $('#discount_price');
        let videoLink = $('#video_link');


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
            description.val(editor.root.innerHTML);
        });

        var delta = editor.clipboard.convert(`{!! $product->description !!}`);
        editor.setContents(delta, 'silent');

        function isQuillEmpty() {
            return editor.getText().trim().length === 0 && editor.container.firstChild.innerHTML.includes("img") === false;
        }

        function scrollTop() {
            window.scrollTo(0, 0);
        }

        function showError(fieldId) {
            $(fieldId + 'Error').show();
            $(fieldId).addClass('is-invalid');
        }

        function hideError(fieldId) {
            $(fieldId + 'Error').hide();
            $(fieldId).removeClass('is-invalid');
        }

        function validateForm() {
            let hasErrors = false;
            console.log(title.val());
            if (title.val() === '' || title.val().length > 255) {
                hasErrors = true;
                showError('#title');
            } else {
                hideError('#title');
            }
            if (isQuillEmpty()) {
                hasErrors = true;
                showError('#editor');
            } else {
                hideError('#editor');
            }
            if (code.val() === '' || code.val().length > 255) {
                hasErrors = true;
                showError('#code');
            } else {
                hideError('#code');
            }
            if (quantity.val() === '' || quantity.val().length > 255) {
                hasErrors = true;
                showError('#quantity');
            } else {
                hideError('#quantity');
            }
            if (brand.val() === '' || brand.val().length > 255) {
                hasErrors = true;
                showError('#brand');
            } else {
                hideError('#brand');
            }
            if (color.val() === '' || color.val().length > 255) {
                hasErrors = true;
                showError('#color');
            } else {
                hideError('#color');
            }
            if (size.val() === '' || size.val().length > 255) {
                hasErrors = true;
                showError('#size');
            } else {
                hideError('#size');
            }
            if (sellingPrice.val() === '' || sellingPrice.val().length > 255) {
                hasErrors = true;
                showError('#selling_price');
            } else {
                hideError('#selling_price');
            }
            if (discountPrice.val() === '' || discountPrice.val().length > 255) {
                hasErrors = true;
                showError('#discount_price');
            } else {
                hideError('#discount_price');
            }
            if (videoLink.val() === '' || videoLink.val().length > 255) {
                hasErrors = true;
                showError('#video_link');
            } else {
                hideError('#video_link');
            }

            if (hasErrors) {
                scrollTop();
            }
            return hasErrors;
        }

        function getImages(productId) {
            $.ajax({
                type: 'GET',
                "_token": "{{ csrf_token() }}",
                url: '/admin/products/get-product-images/' + productId,
                success: function (data) {
                    data.forEach(function (data) {
                        fetch(data.image)
                            .then(res => res.blob())
                            .then(blob => {
                                uppy.addFile({
                                    name: data.name, // file name
                                    type: 'image/jpeg', // file type
                                    data: blob, // file blob
                                    source: 'Local', // optional, determines the source of the file, for example, Instagram
                                    isRemote: false // optional, set to true if actual file is not in the browser, but on some remote server, for example, when using companion in combination with Instagram
                                })
                            });
                    })
                }
            });
        }

        getImages({{ $product->id }});
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
            endpoint: '{{ route('admin.products.update', $product->id) }}',
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
            triggerUploadOnSubmit: false,
        })

        uppy.on('complete', () => {
            window.location.replace('{{ route('admin.products') }}');
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
                    data.subCategories.forEach(function (subCategory) {
                        subCategoriesSelect.append(new Option(subCategory.name, subCategory.id));
                    });

                }
            });
        }

        $('#category').on('change', function () {
            let category_id = $(this).val();
            getSubCategories(category_id);
        });

        btnSubmit = $('#btn-submit');
        productForm = $('#product-form');


        btnSubmit.on('click', function () {
            if (!validateForm()) {
                uppy.upload();
            }
        });
    </script>
@endsection