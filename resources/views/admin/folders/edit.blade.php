<x-app-layout>
    @section('css')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa;
            }

            .form-card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            }

            .form-card-header {
                background-color: #ffffff;
                border-bottom: 1px solid #dee2e6;
                font-weight: 600;
                font-size: 1.25rem;
                padding: 1rem 1.5rem;
            }

            .form-control:focus {
                border-color: #0d6efd;
                box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
            }

            .btn-primary {
                border-radius: 30px;
                padding-left: 20px;
                padding-right: 20px;
            }
        </style>
    @stop

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card form-card">
                    <div class="form-card-header">{{ __('✏️ Edit Folder') }}</div>

                    <div class="card-body p-4">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.folders.update', $folder->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">📁 Folder Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $folder->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">📝 Description (optional)</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $folder->description) }}</textarea>
                            </div>

                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i> Update Folder
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
