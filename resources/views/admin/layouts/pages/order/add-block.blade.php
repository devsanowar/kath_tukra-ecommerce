<!-- Modal HTML -->
<div class="modal fade" id="blocklistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="blocklistForm" action="{{ route('block.number') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add to Blocklist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label><b>Phone Number</b></label>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="material-icons">call</i></span>
                            <div class="form-line" style="border:1px solid #b1b1b1">
                                <input type="text" class="form-control" name="number" placeholder="Enter number">
                            </div>
                        </div>
                        <div class="text-danger font-weight-bold mt-2" id="numberError"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


