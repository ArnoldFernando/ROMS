<x-app-layout>
    @section('css')
        <!-- Bootstrap 5 & DataTables -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa;
            }

            .table th,
            .table td {
                vertical-align: middle;
            }

            .table thead {
                background-color: #212529;
                color: #fff;
            }

            .btn-sm {
                margin-right: 4px;
            }

            .modal-content {
                border-radius: 0.5rem;
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            }

            .modal-header,
            .modal-footer {
                border: none;
            }

            .modal-title {
                font-weight: 600;
            }

            .btn-close {
                filter: brightness(0) invert(0.5);
            }

            .btn-primary,
            .btn-secondary,
            .btn-warning {
                font-weight: 500;
            }
        </style>
    @endsection

    @section('content_header')
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="fw-semibold text-md mb-0">📁 Folder: {{ $folder->name }}</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFileModal">➕ Upload File</button>
        </div>
        <hr class="mt-2">
    @endsection

    @section('content')
        <div class="container-fluid mt-3">

            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                    &larr; Go Back
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle" id="myTable">
                    <thead>
                        <tr>
                            <th>📑 Document Code</th>
                            <th>📌 Subject</th>
                            <th>🏢 Office</th>
                            <th>📝 Remarks</th>
                            <th>📅 Date</th>
                            <th>📂 File</th>
                            <th>⚙️ Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($folder->files as $file)
                            <tr>
                                <td>{{ $file->document_code }}</td>
                                <td>{{ $file->subject }}</td>
                                <td>{{ $file->originating_office }}</td>
                                <td>{{ $file->remarks }}</td>
                                <td>{{ $file->date }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $file->file) }}" target="_blank"
                                        class="btn btn-sm btn-outline-secondary">View</a>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                            data-bs-target="#viewFileModal{{ $file->id }}">
                                            <i class="bi bi-eye"></i> View
                                        </button>
                                        <a href="{{ route('admin.files.edit', $file->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.files.archive', $file->id) }}" method="POST"
                                            onsubmit="return confirm('Archive this file?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                <i class="bi bi-archive"></i> Archive
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            @include('admin.modal.view', ['file' => $file])
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



        @include('admin.modal.add', ['folder' => $folder])
    @endsection

    @section('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                new DataTable('#myTable');
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    confirmButtonText: 'OK'
                });
            @endif
        </script>
    @endsection
</x-app-layout>
