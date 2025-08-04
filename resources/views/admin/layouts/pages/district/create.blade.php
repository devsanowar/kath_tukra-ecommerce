<div class="modal fade" id="addDistrictModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add District</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('district.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-4">
                        <label><b>District</b></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">payments</i></span>
                            <div class="form-line case-input">
                                <input type="text" class="form-control" name="district_name" placeholder="Enter District Name">
                            </div>
                            <div class="text-danger font-weight-bold mt-2" id="districtError"></div>
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
                        <button type="submit" class="btn btn-info text-white text-uppercase">Save District</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
