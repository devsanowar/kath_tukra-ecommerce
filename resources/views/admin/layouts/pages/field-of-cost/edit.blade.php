<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editDistrictLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDistrictLabel">Edit Field</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm">
                    @csrf
                    <input type="hidden" id="edit_category_id" name="id">
                    <div class="form-group mb-4">
                        <label><b>Field Name</b></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">category</i></span>
                            <div class="form-line case-input">
                                <input type="text" id="edit_category_name" class="form-control" name="field_of_cost" required>
                            </div>
                            <div class="text-danger font-weight-bold mt-2" id="districtError"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control show-tick" id="edit_is_active" name="is_active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update Field</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')

<script>
$(document).ready(function () {

    $(".editcategory").click(function () {
        const fieldId = $(this).data("id");
        const fieldOfCost = $(this).data("name");
        const status = $(this).data("status");

        $("#edit_category_id").val(fieldId);
        $("#edit_category_name").val(fieldOfCost);
        $('#edit_is_active').val(String(status)).trigger('change');

        $("#editCategoryModal").modal("show");
    });

    $("#editCategoryForm").submit(function (e) {
        e.preventDefault();

        const fieldId = $("#edit_category_id").val();
        const fieldOfCost = $("#edit_category_name").val();
        const isActive = $("#edit_is_active").val();

        $.ajax({
            url: "{{ route('field_of_cost.update') }}",
            type: "POST",
            data: {
                _token: $("input[name=_token]").val(),
                id: fieldId,
                field_of_cost: fieldOfCost,
                is_active: isActive,
            },
            success: function (response) {
                if (response.success) {
                    toastr.success(response.success);

                    const row = $("#categoryRow-" + fieldId);
                    row.find(".category-name").text(response.field_of_cost);

                    const statusBtn = row.find(".category-status");
                    statusBtn
                        .text(response.is_active == 1 ? 'Active' : 'DeActive')
                        .removeClass("btn-success btn-danger")
                        .addClass(response.is_active == 1 ? 'btn-success' : 'btn-danger');

                    // update data-* attributes on edit button
                    row.find(".editcategory")
                        .data("name", response.field_of_cost)
                        .data("status", response.is_active);

                    $("#editCategoryModal").modal("hide");

                    setTimeout(() => {
                        location.reload();
                    }, 100);
                } else {
                    toastr.error("Update failed.");
                }
            },
            error: function (xhr) {
                toastr.error("Something went wrong.");
                console.error(xhr.responseText);
            }
        });
    });
});
</script>


@endpush

