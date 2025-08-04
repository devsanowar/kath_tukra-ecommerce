// Show popup for delete confirmation
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



// Pagelength override scripts

    $.extend(true, $.fn.dataTable.defaults, {
    "pageLength": 20,
    "lengthMenu": [ [10, 20, 50, -1], [10, 20, 50, "All"] ]
    });

    $(document).ready(function() {
        $('#upazilaDataTable').DataTable();
    });




$(document).ready(function () {
    // Use event delegation here
    $(document).on('click', '.editUpazila', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let district = $(this).data('district');
        let shipping = $(this).data('shipping');
        let status = $(this).data('status');

        $('#upazila_id').val(id);
        $('#upazila_name').val(name);
        $('#shipping_cost').val(shipping);
        $('#district_id').val(district).trigger('change');
        $('#is_active').val(status).trigger('change');

        $('#editUpazilaModal').modal('show');
    });

    $('#updateUpazilaForm').submit(function (e) {
        e.preventDefault();

        let id = $('#upazila_id').val();
        let formData = {
            _token: '{{ csrf_token() }}',
            _method: 'PUT',
            upazila_name: $('#upazila_name').val(),
            district_id: $('#district_id').val(),
            shipping_cost: $('#shipping_cost').val(),
            is_active: $('#is_active').val()
        };

        $.ajax({
            url: "{{ route('upazilas.update', '') }}/" + id,
            type: "POST",
            data: formData,
            success: function (response) {
                toastr.success("Upazila updated successfully!");
                $('#editUpazilaModal').modal('hide');
                location.reload(); // Or you can re-fetch the table data via Ajax instead of full reload
            },
            error: function (error) {
                toastr.error("Something went wrong! Try again.");
            }
        });
    });
});




// Status Change script

    $(document).on('click', '.status-toggle-btn', function(e) {
        e.preventDefault();

        let button = $(this);
        let upazilaId = button.data('id');

        $.ajax({
            url: upazilaStatusRoute,
            type: 'POST',
            data: {
                _token: csrfToken,
                id: upazilaId
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
