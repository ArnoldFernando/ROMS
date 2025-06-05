  <!-- Modal inside loop -->
  <div class="modal fade" id="viewFileModal{{ $file->id }}" tabindex="-1"
      aria-labelledby="viewFileModalLabel{{ $file->id }}" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">

              <div class="modal-header">
                  <h5 class="modal-title" id="viewFileModalLabel{{ $file->id }}">File Details
                  </h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">
                  <p><strong>Document Code:</strong> {{ $file->document_code }}</p>
                  <p><strong>Subject:</strong> {{ $file->subject }}</p>
                  <p><strong>Originating Office:</strong> {{ $file->originating_office }}</p>
                  <p><strong>Remarks:</strong> {{ $file->remarks }}</p>
                  <p><strong>Date:</strong> {{ $file->date }}</p>
                  <p><strong>File:</strong>
                      <a href="{{ asset('storage/' . $file->file) }}" target="_blank">View
                          File</a>
                  </p>
              </div>

              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>

          </div>
      </div>
  </div>
