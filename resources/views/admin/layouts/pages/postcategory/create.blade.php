<div class="modal fade" id="addPostcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('post_category.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-4">
                        <label><b>Category Name</b></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">payments</i></span>
                            <div class="form-line case-input">
                                <input type="text" class="form-control" name="category_name" placeholder="Enter Category Name">
                            </div>
                            <div class="text-danger font-weight-bold mt-2" id="categoryError"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label><b>Status</b></label>
                        <select class="form-control show-tick" name="is_active">
                            <option value="">Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Deactive</option>
                        </select>
                        <div class="text-danger font-weight-bold mt-2" id="statusError"></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning text-white text-uppercase" data-dismiss="modal">Hide</button>
                        <button type="submit" class="btn btn-info text-white text-uppercase">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
