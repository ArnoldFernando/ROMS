<h5 class="fw-semibold">Search Results for "<span class="text-primary">{{ $searchResults['query'] }}</span>"</h5>
<hr>

@if ($searchResults['files']->isEmpty() && $searchResults['matchedFolders']->isEmpty())
    <div class="alert alert-warning">No results found.</div>
@endif

{{-- FILES --}}
@if ($searchResults['files']->isNotEmpty())
    <h6 class="text-primary mb-3"><i class="fas fa-file-alt me-2"></i>Matching Files</h6>
    <div class="row row-cols-1 row-cols-md-2 g-3 mb-4">
        @foreach ($searchResults['files'] as $file)
            <div class="col">
                <div class="card shadow-sm h-100 hover-shadow border-0">
                    <div class="card-body">
                        <h5>
                            <i class="fas fa-file-alt text-primary me-2"></i>{{ $file->document_code }}
                        </h5>
                        <p class="mb-1"><strong>Subject:</strong> {{ $file->subject }}</p>
                        <p class="mb-1"><strong>Office:</strong> {{ $file->originating_office }}</p>
                        <p class="mb-0"><strong>Date:</strong>
                            {{ \Carbon\Carbon::parse($file->date)->format('F d, Y') }}</p>
                        <button class="btn btn-sm btn-primary mt-3" data-bs-toggle="modal"
                            data-bs-target="#fileModal{{ $file->id }}">
                            <i class="fas fa-eye me-1"></i> View Details
                        </button>
                    </div>
                </div>
            </div>

            {{-- Modal --}}
            <div class="modal fade" id="fileModal{{ $file->id }}" tabindex="-1"
                aria-labelledby="fileModalLabel{{ $file->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary text-white">
                            <h5 class="modal-title" id="fileModalLabel{{ $file->id }}">File Details -
                                {{ $file->document_code }}</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Folder:</strong>
                                @if ($file->folder)
                                    <i>{{ $file->folder->name }}</i>
                                @else
                                    <span class="text-muted">No folder assigned</span>
                                @endif
                            </p>
                            <p><strong>Document Code:</strong> {{ $file->document_code }}</p>
                            <p><strong>Subject:</strong> {{ $file->subject }}</p>
                            <p><strong>Originating Office:</strong> {{ $file->originating_office }}</p>
                            <p><strong>Remarks:</strong> {{ $file->remarks }}</p>
                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($file->date)->format('F d, Y') }}</p>
                            <p><strong>File:</strong>
                                @if ($file->file)
                                    <a href="{{ asset('storage/' . $file->file) }}" target="_blank">Open File</a>
                                @else
                                    <span class="text-muted">No file uploaded</span>
                                @endif
                            </p>
                        </div>
                        <div class="modal-footer">
                            <a href="{{ route('admin.files.show', $file->id) }}" class="btn btn-outline-primary">Go to
                                Full View</a>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif

{{-- FOLDERS --}}
@if ($searchResults['matchedFolders']->isNotEmpty())
    <h6 class="text-warning mb-3"><i class="fas fa-folder me-2"></i>Matching Folders</h6>
    <div class="row row-cols-1 row-cols-md-2 g-3">
        @foreach ($searchResults['matchedFolders'] as $folder)
            <div class="col">
                <a href="{{ route('admin.folders.show', $folder->id) }}" class="text-decoration-none text-dark">
                    <div class="card shadow-sm h-100 hover-shadow border-0">
                        <div class="card-body">
                            <h5><i class="fas fa-folder text-warning me-2"></i>{{ $folder->name }}</h5>
                            <p class="mb-0">{{ $folder->description }}</p>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endif
