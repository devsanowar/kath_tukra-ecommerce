$.extend(true, $.fn.dataTable.defaults, {
    "pageLength": 20,
    "lengthMenu": [ [10, 20, 50, -1], [10, 20, 50, "All"] ]
    });

    $(document).ready(function() {
        $('#postCategoryDataTable').DataTable();
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


$(document).ready(function () {
    $(".delete-category-btn").click(function (e) {
        e.preventDefault();

        const button = $(this);
        const form = button.closest(".delete-category-form");
        const categoryId = form.data("id");
        const deleteUrl = "/admin/post-category/destroy/" + categoryId;
        const csrfToken = form.find('input[name="_token"]').val();

        if (confirm("Are you sure you want to delete this category?")) {
            $.ajax({
                url: deleteUrl,
                type: "POST",
                data: {
                    _token: csrfToken,
                    _method: "DELETE"
                },
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.success);

                        // ডিলিট হওয়া Row রিমুভ করো
                        $("#categoryRow-" + categoryId).remove();
                    } else {
                        toastr.error("Deletion failed.");
                    }
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    toastr.error("Something went wrong.");
                }
            });
        }
    });
});

