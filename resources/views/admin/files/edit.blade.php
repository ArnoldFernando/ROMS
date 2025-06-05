<x-app-layout>
    <div class="container max-w-4xl mx-auto p-5 bg-white rounded shadow-sm">
        <h2 class="h4 fw-semibold mb-4">✏️ Edit File Details from {{ $folder->name }} folder</h2>

        <form action="{{ route('admin.files.update', $file->id) }}" method="POST" enctype="multipart/form-data"
            novalidate>
            @csrf
            @method('PUT')

            <input type="hidden" name="folder_id" value="{{ $folder->id }}">

            <div class="mb-3">
                <label for="document_code" class="form-label fw-semibold">Document Code</label>
                <input id="document_code" type="text" name="document_code"
                    value="{{ old('document_code', $file->document_code) }}" required
                    class="form-control @error('document_code') is-invalid @enderror">
                @error('document_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="subject" class="form-label fw-semibold">Subject</label>
                <input id="subject" type="text" name="subject" value="{{ old('subject', $file->subject) }}"
                    required class="form-control @error('subject') is-invalid @enderror">
                @error('subject')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="originating_office" class="form-label fw-semibold">Originating Office</label>
                <input id="originating_office" type="text" name="originating_office"
                    value="{{ old('originating_office', $file->originating_office) }}" required
                    class="form-control @error('originating_office') is-invalid @enderror">
                @error('originating_office')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="remarks" class="form-label fw-semibold">Remarks</label>
                <textarea id="remarks" name="remarks" rows="3" required
                    class="form-control @error('remarks') is-invalid @enderror">{{ old('remarks', $file->remarks) }}</textarea>
                @error('remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date" class="form-label fw-semibold">Date</label>
                <input id="date" type="date" name="date" value="{{ old('date', $file->date) }}" required
                    class="form-control @error('date') is-invalid @enderror">
                @error('date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="file" class="form-label fw-semibold">
                    Upload New File <small class="text-muted">(optional)</small>
                </label>
                <input id="file" type="file" name="file" accept=".pdf,.doc,.docx,.jpg,.png"
                    class="form-control @error('file') is-invalid @enderror">
                <small class="form-text text-muted">Leave empty to keep the current file.</small>
                @error('file')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    @section('css')
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa;
            }
        </style>
    @endsection

    @section('js')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endsection
</x-app-layout>
