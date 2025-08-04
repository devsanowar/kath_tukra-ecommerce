<div class="modal fade" id="editDistrictModal" tabindex="-1" aria-labelledby="editDistrictLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDistrictLabel">Edit District</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editDistrictForm">
                    @csrf
                    <input type="hidden" id="edit_district_id" name="district_id">


                    <div class="form-group mb-4">
                        <label><b>District</b></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">pin_drop</i></span>
                            <div class="form-line case-input">
                                <input type="text" class="form-control" name="district_name" id="edit_district_name"  placeholder="Enter District Name">
                            </div>
                            <div class="text-danger font-weight-bold mt-2" id="districtError"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control show-tick" id="is_active" name="is_active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-info">Update District</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function () {
     $(".editDistrict").click(function () {
         const districtId = $(this).data("id");
         const districtName = $(this).data("name");
         const status = $(this).data('status');

         // Populate modal fields
         $("#edit_district_id").val(districtId);
         $("#edit_district_name").val(districtName);
         $('#is_active').val(status).trigger('change');

         // Show the modal
         $("#editDistrictModal").modal("show");
     });

     // Handle form submission
     $("#editDistrictForm").submit(function (e) {
         e.preventDefault(); // Prevent default form submission

         const districtId = $("#edit_district_id").val();

         const formData = {
             _token: "{{ csrf_token() }}",
             id: districtId,
             district_name: $("#edit_district_name").val(),
         };

         $.ajax({
             url: "/admin/district/update", // Ensure correct URL
             type: "POST",
             data: formData,
             dataType: "json",
             success: function (response) {
                 if (response.success) {
                     toastr.success(response.success, "Success", {
                         timeOut: 3000,  // 3 seconds
                         closeButton: true,
                         progressBar: true
                     });

                     // Update table row dynamically
                     $("#districtRow-" + districtId + " .district-name").text(formData.district_name);

                     // Hide the modal
                     $("#editDistrictModal").modal("hide");
                 } else {
                     toastr.error("Error updating district.", "Error");
                 }
             },
             error: function (xhr) {
                 console.error("Error: ", xhr.responseText);
                 toastr.error("Something went wrong!", "Error");
             }
         });
     });
 });


 </script>
@endpush

