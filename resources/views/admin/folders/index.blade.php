<x-app-layout>

    @section('css')
        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa;
            }

            .folder-card {
                transition: all 0.3s ease-in-out;
                border: none;
                border-radius: 12px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
                cursor: pointer;
            }

            .folder-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            }

            .folder-icon {
                font-size: 3rem;
                color: #ffc107;
            }

            .btn-create {
                border-radius: 30px;
                padding-left: 20px;
                padding-right: 20px;
            }

            .card-footer {
                background-color: #fff;
                border-top: none;
            }
        </style>
    @stop

    @section('content_header')
        <h5 class="fw-semibold text-md">📁 All Folders</h5>
        <hr class="mt-0 mb-4">
    @stop

    @section('content')
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <a href="{{ route('admin.folders.create') }}" class="btn btn-primary btn-create">
                    <i class="fas fa-plus me-1"></i> Create New Folder
                </a>
            </div>

            @if ($folders->count())
                <div class="row g-4">
                    @foreach ($folders as $folder)
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                            <a href="{{ route('admin.folders.show', $folder->id) }}"
                                style="text-decoration: none; color: inherit;">
                                <div class="card folder-card text-center h-100">
                                    <div class="card-body">
                                        <i class="fas fa-folder folder-icon mb-3"></i>
                                        <h6 class="fw-semibold">{{ $folder->name }}</h6>
                                        <small class="text-muted">{{ $folder->created_at->format('Y-m-d') }}</small>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('admin.folders.edit', $folder->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="alert alert-info">No folders found.</div>
            @endif
        </div>
    @stop

</x-app-layout>
