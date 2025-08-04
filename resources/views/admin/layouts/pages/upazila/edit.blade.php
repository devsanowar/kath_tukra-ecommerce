 <div class="modal fade" id="editUpazilaModal" tabindex="-1" aria-labelledby="editUpazilaModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="editUpazilaModalLabel">Edit Upazila</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form id="updateUpazilaForm">
                     @csrf
                     @method('PUT')

                     <input type="hidden" id="upazila_id">

                     <!-- Upazila Name -->
                     <div class="mb-3">
                         <label class="form-label">Upazila Name</label>
                         <input type="text" class="form-control" id="upazila_name" required>
                     </div>

                     <!-- District -->
                     <div class="mb-3">
                         <label class="form-label">District</label>
                         <select class="form-control show-tick" data-live-search="true" id="district_id" required>
                             <option value="">Select District</option>
                             @foreach ($districts as $district)
                                 <option value="{{ $district->id }}">{{ $district->district_name }}</option>
                             @endforeach
                         </select>

                     </div>


                     <!-- Status -->
                     <div class="mb-3">
                         <label class="form-label">Status</label>
                         <select class="form-control show-tick" id="is_active" name="is_active">
                             <option value="1">Active</option>
                             <option value="0">Inactive</option>
                         </select>
                     </div>

                     <button type="submit" class="btn btn-primary">Update</button>
                 </form>
             </div>
         </div>
     </div>
 </div>
