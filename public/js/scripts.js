//datatable initialize
$(document).ready(function () {

    $('#datatable').DataTable();

});


//modal
$('#new-category-modal').on('shown.bs.modal', function () {
    $('#category_name').trigger('focus');
    let submit_button = document.getElementById('submit-button');
    submit_button.addEventListener('click', function () {
        document.getElementById('submit-form').submit();
    });
})

