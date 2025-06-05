<x-app-layout>
    @section('css')
        <!-- Bootstrap 5 & DataTables CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f4f6f9;
            }

            .card {
                border: none;
                border-radius: 12px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
                overflow: hidden;
            }

            .table thead {
                background-color: #343a40;
                color: white;
            }

            .btn-sm {
                font-size: 0.8rem;
            }

            .modal-content {
                border-radius: 10px;
            }

            .modal-title {
                font-weight: 600;
            }

            .table td,
            .table th {
                vertical-align: middle;
            }
        </style>
    @stop

    @section('content_header')
        <h4 class="fw-semibold text-dark mb-2">📄 All Uploaded Files</h4>
        <hr class="mt-0">
    @stop

    @section('content')
        <div class="container-fluid">


            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary mb-4">
                    &larr; Go Back
                </a>
            </div>
            <div class="card p-4">
                <table class="table table-hover table-striped table-bordered" id="myTable">
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
                        @foreach ($files as $file)
                            <tr>
                                <td>{{ $file->document_code }}</td>
                                <td>{{ $file->subject }}</td>
                                <td>{{ $file->originating_office }}</td>
                                <td>{{ $file->remarks }}</td>
                                <td>{{ $file->date }}</td>
                                <td>
                                    <a href="{{ asset('storage/' . $file->file) }}" target="_blank"
                                        class="btn btn-outline-primary btn-sm">View</a>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#viewFileModal{{ $file->id }}">
                                        Details
                                    </button>
                                </td>
                            </tr>

                            <!-- Modal -->
                            <div class="modal fade" id="viewFileModal{{ $file->id }}" tabindex="-1"
                                aria-labelledby="viewFileModalLabel{{ $file->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title" id="viewFileModalLabel{{ $file->id }}">File Details
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Document Code:</strong> {{ $file->document_code }}</p>
                                            <p><strong>Subject:</strong> {{ $file->subject }}</p>
                                            <p><strong>Originating Office:</strong> {{ $file->originating_office }}</p>
                                            <p><strong>Remarks:</strong> {{ $file->remarks }}</p>
                                            <p><strong>Date:</strong> {{ $file->date }}</p>
                                            <p><strong>File:</strong>
                                                <a href="{{ asset('storage/' . $file->file) }}" target="_blank"
                                                    class="btn btn-sm btn-primary">Open File</a>
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection

    @section('js')
        <!-- JS Libraries -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

        <!-- DataTables Setup -->
        <script>
            new DataTable('#myTable', {
                responsive: true,
                layout: {
                    topStart: {
                        pageLength: {
                            menu: [10, 25, 50, 100]
                        }
                    },
                    topEnd: {
                        search: {
                            placeholder: 'Search files...'
                        }
                    }
                },
                language: {
                    lengthMenu: "_MENU_ per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ files",
                    infoEmpty: "No files found",
                    infoFiltered: "(filtered from _MAX_ total)",
                    search: "🔍",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "›",
                        previous: "‹"
                    }
                }
            });
        </script>
    @endsection
</x-app-layout>
