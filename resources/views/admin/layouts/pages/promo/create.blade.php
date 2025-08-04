<div class="modal fade" id="addPromoBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Promo Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('promobanner.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group mb-4">
                        <label><b>Image</b></label>
                        <div class="input-group">
                            <div class="form-line case-input">
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="text-danger font-weight-bold mt-2" id="imageError"></div>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label><b>Page Url</b></label>
                        <div class="input-group">
                            <div class="form-line case-input">
                                <input type="text" class="form-control pl-2" name="url" placeholder="Enter Page Url">
                            </div>
                            <div class="text-danger font-weight-bold mt-2" id="urlError"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><b>Status</b></label>
                        <select class="form-control show-tick" name="is_active">
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                        <div class="text-danger font-weight-bold mt-2" id="statusError"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning text-white text-uppercase" data-dismiss="modal">Hide</button>
                        <button type="submit" class="btn btn-info text-white text-uppercase">Save Promo Banner</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
