

//delete button
$('.btn-delete').on('click', function (event) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            event.target.closest('form').submit();
        }
    })
})


//modal new category
$('#add-category-modal').on('show.bs.modal', function () {
    submitButtonEvent();

}).on('shown.bs.modal', function () {
    $('#add-category-modal input[name="category_name"]').trigger('focus');
})

//modal edit category
$('#edit-category-modal').on('show.bs.modal', function (event) {


    let button = $(event.relatedTarget);
    let category_id = button.data('category_id');
    let category_name = button.data('category_name');

    let modal = $(this);
    modal.find('.modal-body #edit-submit-form input[name="category_name"]').val(category_name);

    let form = document.getElementById('edit-submit-form');
    let submit_button = document.getElementById('edit-submit-button');

    form.addEventListener('submit', function () {
        replaceRouteAction('edit-submit-form', category_id);
    });

    submit_button.addEventListener('click', function () {
        replaceRouteAction('edit-submit-form', category_id);
        form.submit();
    });
}).on('shown.bs.modal', function () {
    $('#edit-category-modal input[name="category_name"]').trigger('focus');
});

//modal new sub category
$('#add-sub-category-modal').on('show.bs.modal', function () {
    submitButtonEvent();

}).on('shown.bs.modal', function () {
    $('#add-sub-category-modal input[name="sub_category_name"]').trigger('focus');
})

//modal edit sub category
$('#edit-sub-category-modal').on('show.bs.modal', function (event) {


    let button = $(event.relatedTarget);
    let category_id = button.data('category_id');
    let sub_category_id = button.data('sub_category_id');
    let sub_category_name = button.data('sub_category_name');

    let modal = $(this);
    modal.find('.modal-body #edit-submit-form input[name="sub_category_name"]').val(sub_category_name);
    $('#edit_select_category_id option').each(function (){
        if(category_id === parseInt(this.value)){
            this.selected = true;
        }
    });

    let form = document.getElementById('edit-submit-form');
    let submit_button = document.getElementById('edit-submit-button');

    form.addEventListener('submit', function () {
        replaceRouteAction('edit-submit-form', sub_category_id);
    });

    submit_button.addEventListener('click', function () {
        replaceRouteAction('edit-submit-form', sub_category_id);
        form.submit();
    });
}).on('shown.bs.modal', function () {
    $('#edit-category-modal input[name="category_name"]').trigger('focus');
});
//modal edit coupon
$('#edit-coupon-modal').on('show.bs.modal', function (event) {


    let button = $(event.relatedTarget);
    let coupon_id = button.data('coupon_id');
    let coupon_name = button.data('coupon_name');
    let disc_name = button.data('disc_name');

   /* let modal = $(this);
    modal.find('.modal-body #edit-submit-form input[name="sub_category_name"]').val(sub_category_name);
    $('#edit_select_category_id option').each(function (){
        if(category_id === parseInt(this.value)){
            this.selected = true;
        }
    });*/

    let form = document.getElementById('edit-submit-form');
    let submit_button = document.getElementById('edit-submit-button');

    form.addEventListener('submit', function () {
        replaceRouteAction('edit-submit-form', coupon_id);
    });

    submit_button.addEventListener('click', function () {
        replaceRouteAction('edit-submit-form', coupon_id);
        form.submit();
    });
}).on('shown.bs.modal', function () {
    $('#edit-coupon-modal input[name="coupon"]').trigger('focus');
});
function replaceRouteAction(formName, id) {
    let form = document.getElementById(formName);
    form.action = form.action.replace(':id', id);
}

function submitButtonEvent() {
    let submit_button = document.getElementById('add-submit-button');

    submit_button.addEventListener('click', function () {
        document.getElementById('add-submit-form').submit();
    });
}

