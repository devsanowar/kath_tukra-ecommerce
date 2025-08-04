<!-- Edit Shipping Modal -->
<div class="modal fade" id="editShippingModal" tabindex="-1" aria-labelledby="editShippingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editShippingForm" method="POST">
                @csrf
                @method('PUT') {{-- method spoofing --}}
                <div class="modal-header">
                    <h5 class="modal-title">Edit Shipping</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Shipping Area</label>
                        <input type="text" class="form-control" name="shipping_area" id="edit_shipping_area"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Shipping Charge</label>
                        <input type="number" class="form-control" name="shipping_charge" id="edit_shipping_charge"
                            required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control show-tick" name="is_active" id="edit_is_active">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Shipping</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        const updateShippingRoute = "{{ route('shipping.update', ['id' => '__id__']) }}";

        $('.editShippingBtn').on('click', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const charge = $(this).data('charge');
            const status = $(this).data('status');

            $('#edit_shipping_area').val(name);
            $('#edit_shipping_charge').val(charge);
            $('#edit_is_active').val(status).change(); // Make sure selected option reflects value

            const url = updateShippingRoute.replace('__id__', id);
            $('#editShippingForm').attr('action', url);

            $('#editShippingModal').modal('show');
        });
    </script>
@endpush
