   <!-- Add File Modal -->
   <div class="modal fade" id="addFileModal" tabindex="-1" aria-labelledby="addFileModalLabel" aria-hidden="">
       <div class="modal-dialog">
           <div class="modal-content">
               <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
                   @csrf
                   <input type="hidden" name="folder_id" value="{{ $folder->id }}">

                   <div class="modal-header">
                       <h5 class="modal-title">Add File to {{ $folder->name }}</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   </div>

                   <div class="modal-body">

                       <div class="mb-3">
                           <label for="document_code" class="form-label">Document Code</label>
                           <input type="text" name="document_code" class="form-control" id="document_code">
                       </div>

                       <div class="mb-3">
                           <label for="subject" class="form-label">Subject</label>
                           <input type="text" name="subject" class="form-control" id="subject" required>
                       </div>

                       <div class="mb-3">
                           <label for="originating_office" class="form-label">Originating Office</label>
                           <input type="text" name="originating_office" class="form-control" id="originating_office">
                       </div>

                       <div class="mb-3">
                           <label for="remarks" class="form-label">Remarks</label>
                           <input type="text" name="remarks" class="form-control" id="remarks">
                       </div>

                       <div class="mb-3">
                           <label for="date" class="form-label">Date</label>
                           <input type="date" name="date" class="form-control" id="date">
                       </div>

                       <div class="mb-3">
                           <label for="file" class="form-label">Choose File(s)</label>
                           <input type="file" name="file[]" class="form-control" id="file" multiple required>
                       </div>

                   </div>

                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                       <button type="submit" class="btn btn-success">Upload File</button>
                   </div>
               </form>
           </div>
       </div>
   </div>
