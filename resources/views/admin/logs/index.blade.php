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
        <h5 class="fw-semibold text-md">All Files</h5>
        <hr class="mt-0">
    @stop

    @section('content')
        <div class="container-fluid">
            <h2 class="mb-4">Activity Logs for Files</h2>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Event</th>
                        <th>Changed</th>
                        <th>User</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                            <td>{{ $log->description }}</td>
                            <td>
                                @if ($log->properties && isset($log->properties['attributes']))
                                    @foreach ($log->properties['attributes'] as $key => $value)
                                        <strong>{{ $key }}:</strong> {{ $value }}<br>
                                    @endforeach
                                @else
                                    <em>No attributes logged</em>
                                @endif
                            </td>
                            <td>{{ $log->causer?->name ?? 'System' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No activity found.</td>
                        </tr>
                    @endforelse
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
        </script>
    @endsection
</x-app-layout>
