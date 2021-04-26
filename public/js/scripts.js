//datatable initialize
$(document).ready(function () {
    $('#datatable').DataTable({
        "pagingType": "full_numbers"
    });
});

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
    $('#add-category-modal input[name="category_name"]').trigger('focus');
    let submit_button = document.getElementById('add-submit-button');
    submit_button.addEventListener('click', function () {
        document.getElementById('add-submit-form').submit();
    });
})

//modal edit category
$('#edit-category-modal').on('show.bs.modal', function (event) {
    $('#edit-category-modal input[name="category_name"]').trigger('focus');

    let button = $(event.relatedTarget);
    let category_id = button.data('category_id');
    let category_name = button.data('category_name');

    let modal = $(this)
    modal.find('.modal-body #edit-submit-form input[name="category_name"]').val(category_name);

    let form = document.getElementById('edit-submit-form');
    let submit_button = document.getElementById('edit-submit-button');

    form.addEventListener('submit', function (){
        replaceRouteAction('edit-submit-form', category_id);
    });

    submit_button.addEventListener('click', function () {
        replaceRouteAction('edit-submit-form', category_id);
        form.submit();
    });
})
function replaceRouteAction(formName, id){
    let form = document.getElementById(formName);
    form.action = form.action.replace(':id', id);
}

