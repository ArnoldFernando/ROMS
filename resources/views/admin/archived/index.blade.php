<x-app-layout>
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

            .table th,
            .table td {
                vertical-align: middle;
            }

            .table thead {
                background-color: #343a40;
                color: #fff;
            }

            .btn-sm {
                margin-right: 4px;
            }
        </style>
    @stop

    @section('content_header')
        <h5 class="fw-semibold text-md">All Archived Files</h5>
        <hr class="mt-0">
    @stop

    @section('content')
        <div class="container-fluid">
            {{--  <div class="d-flex justify-content-end mb-3 gap-2">

                <form method="GET" action="{{ route('files.export.all') }}">
                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-file-export"></i></i> Export to Excel
                    </button>
                </form>
                <a href="{{ route('file.create') }}" class="btn btn-primary"><i class="bi bi-upload"></i> Upload
                    File</a>
            </div>  --}}

            <div>
                <a href="{{ url()->previous() }}" class="btn btn-secondary mb-4">
                    &larr; Go Back
                </a>
            </div>


            <table class="table table-bordered table-striped table-hover" id="myTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Document Code</th>
                        <th>Subject</th>
                        <th>Originating Office</th>
                        <th>Remarks</th>
                        <th>Date</th>
                        <th>File</th>
                        <th>Actions</th>
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
                                <a href="{{ asset('storage/' . $file->file) }}" target="_blank">View File</a>
                            </td>
                            <td>
                                <div class="d-flex">
                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#viewFileModal{{ $file->id }}" title="View Details">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>

                                    <form action="{{ route('admin.archived-files.restore', $file->id) }}" method="POST"
                                        onsubmit="return confirm('Restore this file?')">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" title="Restore File">
                                            <i class="fa-solid fa-trash-can-arrow-up"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="viewFileModal{{ $file->id }}" tabindex="-1"
                            aria-labelledby="viewFileModalLabel{{ $file->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewFileModalLabel{{ $file->id }}">File Details
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Document Code:</strong> {{ $file->document_code }}</p>
                                        <p><strong>Subject:</strong> {{ $file->subject }}</p>
                                        <p><strong>Originating Office:</strong> {{ $file->originating_office }}</p>
                                        <p><strong>Remarks:</strong> {{ $file->remarks }}</p>
                                        <p><strong>Date:</strong> {{ $file->date }}</p>
                                        <p><strong>File:</strong> <a href="{{ asset('storage/' . $file->file) }}"
                                                target="_blank">Open File</a></p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>


    @endsection

    @section('js')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

        <script>
            // Initialize DataTable
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
                            placeholder: 'Search records...'
                        }
                    }
                },
                language: {
                    lengthMenu: " _MENU_ records per page",
                    info: "Showing _START_ to _END_ of _TOTAL_ records",
                    infoEmpty: "No records available",
                    infoFiltered: "(filtered from _MAX_ total records)",
                    search: "Search:",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });

            // Populate modal with data attributes
            $('#viewModal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                $('#modal-file_name').text(button.data('file_name'));
                $('#modal-location').text(button.data('location'));
                $('#modal-description').text(button.data('description'));
                $('#modal-civil_case_number').text(button.data('civil_case_number'));
                $('#modal-lot_number').text(button.data('lot_number'));
                $('#modal-status').text(button.data('status'));
            });
        </script>
    @endsection
</x-app-layout>
