<x-app-layout>
    <div class="container py-5">
        <div class="mx-auto" style="max-width: 480px;">
            <div class="card shadow-sm rounded-lg">
                <div class="card-body p-4">
                    <h2 class="h4 mb-4 text-center fw-semibold text-primary">Create Folder</h2>



                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.folders.store') }}" novalidate>
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label fw-medium">
                                Folder Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="form-control @error('name') is-invalid @enderror"
                                placeholder="Enter folder name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label fw-medium">
                                Description <small class="text-muted">(optional)</small>
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="form-control @error('description') is-invalid @enderror" placeholder="Add a description...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-semibold">
                            Create Folder
                        </button>
                        <div>
                            <a href="{{ url()->previous() }}" class="btn btn-secondary mb-4 d-block w-100 mt-3">
                                &larr; Go Back
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section('css')
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
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
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
    @endsection
</x-app-layout>
