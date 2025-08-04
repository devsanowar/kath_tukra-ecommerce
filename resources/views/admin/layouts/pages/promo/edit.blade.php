<div class="modal fade" id="editPromoBannerModal" tabindex="-1" aria-labelledby="editPromoBannerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPromoBannerLabel">Edit Promo Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editPromoBannerForm">
                    @csrf
                    <input type="hidden" id="promo_banner_id" name="id">


                    <div class="form-group mb-4">
                        <label><b>Image</b></label>
                        <div class="input-group">
                            <div class="form-line case-input">
                                <input type="file" id="edit_image" class="form-control" name="image">
                            </div>
                        </div>
                        <div class="mt-2">
                            <img id="oldImagePreview" src="" alt="Old Image" style="max-height: 60px;">
                        </div>
                        <div class="text-danger font-weight-bold mt-2" id="imageError"></div>
                    </div>

                    <div class="form-group mb-4">
                        <label><b>Page Url</b></label>
                        <div class="input-group">
                            <div class="form-line case-input">
                                <input type="text" name="url" id="promo_url" class="form-control" placeholder="Enter URL" required>
                            </div>
                            <div class="text-danger font-weight-bold mt-2" id="urlError"></div>
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
                        <button type="submit" class="btn btn-info">Update Promo Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function () {

        // ✅ Edit button click
        $(".editPromoBanner").click(function () {
            const promobannerId = $(this).data("id");
            const promobannerImage = $(this).data("image");
            const promobannerUrl = $(this).data("url");
            const status = $(this).data("status");

            // ✅ Image preview cache bust
            const imageWithTimestamp = promobannerImage + '?t=' + new Date().getTime();

            // Set hidden input & status
            $("#promo_banner_id").val(promobannerId);
            $('#is_active').val(String(status)).trigger('change');

            // Set image preview
            $("#oldImagePreview").attr("src", imageWithTimestamp);

            // ✅ Set URL field in modal
            $("#promo_url").val(promobannerUrl);

            // Show modal
            $("#editPromoBannerModal").modal("show");
        });

        // ✅ Form submission
        $("#editPromoBannerForm").submit(function (e) {
            e.preventDefault();

            const form = $('#editPromoBannerForm')[0];
            const formData = new FormData(form);
            const promobannerId = $("#promo_banner_id").val();
            formData.append('_method', 'PUT'); // for PUT

            $.ajax({
                url: "{{ route('promobanner.update') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.success, "Success", {
                            timeOut: 1500,
                            closeButton: true,
                            progressBar: true
                        });

                        // ✅ Update image preview in table
                        $("#promoBannerRow-" + promobannerId + " .promobanner-image img")
                            .attr("src", response.image + '?t=' + new Date().getTime());

                        // ✅ Update status button
                        const button = $("#promoBannerRow-" + promobannerId + " .status-toggle-btn");
                        button.text(response.status);
                        button.removeClass("btn-success btn-danger")
                            .addClass(response.status === 'Active' ? 'btn-success' : 'btn-danger');

                        // ✅ Update URL in the table
                        $("#promoBannerRow-" + promobannerId + " .promobanner-url")
                            .text(response.url);

                        // ✅ Update edit button data attributes
                        $(".editPromoBanner[data-id='" + promobannerId + "']")
                            .data("image", response.image)
                            .data("status", response.status === 'Active' ? 1 : 0)
                            .data("url", response.url);

                        // Hide modal
                        $("#editPromoBannerModal").modal("hide");
                    } else {
                        toastr.error(response.message || "Error updating banner.", "Error");
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
