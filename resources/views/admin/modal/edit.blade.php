<!-- Edit File Modal -->
<div class="modal fade" id="editFileModal{{ $file->id }}" tabindex="-1"
    aria-labelledby="editFileModalLabel{{ $file->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.files.update', $file->id) }}" method="POST" enctype="multipart/form-data"
            class="modal-content bg-white rounded shadow-sm">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title" id="editFileModalLabel{{ $file->id }}">Edit File Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" name="folder_id" value="{{ $folder->id }}">

                <div class="mb-3">
                    <label class="form-label">Document Code</label>
                    <input type="text" class="form-control" name="document_code" value="{{ $file->document_code }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" class="form-control" name="subject" value="{{ $file->subject }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Originating Office</label>
                    <input type="text" class="form-control" name="originating_office"
                        value="{{ $file->originating_office }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Remarks</label>
                    <textarea class="form-control" name="remarks" rows="3" required>{{ $file->remarks }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="date" class="form-control" name="date" value="{{ $file->date }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload New File (optional)</label>
                    <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx,.jpg,.png">
                    <small class="form-text text-muted">Leave empty to keep current file.</small>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
