$('.show_confirm').click(function(event){
    let form = $(this).closest('form');
    event.preventDefault();

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
        }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
            Swal.fire({
            title: "Deleted!",
            text: "Your file has been deleted.",
            icon: "success"
            });
        }
        });

});




$(document).on('click', '.status-toggle-btn', function(e) {
    e.preventDefault();

    let button = $(this);
    let categoryId = button.data('id');

    $.ajax({
        url: categoryStatusRoute,
        type: 'POST',
        data: {
            _token: csrfToken,
            id: categoryId
        },
        success: function(response) {
            if (response.status) {
                button.text(response.new_status);
                button.removeClass('btn-success btn-danger').addClass(response.class);
                toastr.success(response.message, 'Success', {
                    timeOut: 1500,
                    closeButton: true,
                    progressBar: true
                });
            } else {
                toastr.error(response.message, 'Error');
            }
        },
        error: function(xhr) {
            alert('Something went wrong!');
        }
    });
});

