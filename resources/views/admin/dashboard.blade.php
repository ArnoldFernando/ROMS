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

            .table th,
            .table td {
                vertical-align: middle;
            }

            .table thead {
                background-color: #343a40;
                color: #fff;
            }

            .dashboard-card {
                transition: 0.3s ease;
                border: none;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
                border-radius: 12px;
            }

            .dashboard-card:hover {
                transform: translateY(-3px);
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            }

            .dashboard-title {
                font-size: 1rem;
                font-weight: 600;
                color: #495057;
            }

            .dashboard-number {
                font-size: 2rem;
                font-weight: 700;
                color: #0d6efd;
            }

            .btn-primary {
                border-radius: 30px;
                padding-left: 20px;
                padding-right: 20px;
            }
        </style>
    @stop

    @section('content_header')
        <h5 class="fw-semibold text-md">Welcome to <span class="text-primary">Records Office Management System</span>
            Dashboard</h5>
        <hr class="mt-1 mb-4">
    @stop

    @section('content')
        <div class="container">
            <style>
                .dashboard-card {
                    border-radius: 1rem;
                    background: #ffffff;
                    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
                    transition: transform 0.3s, box-shadow 0.3s;
                }

                .dashboard-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
                }

                .dashboard-title {
                    font-size: 1.25rem;
                    font-weight: 600;
                    color: #333;
                    margin-bottom: 5px;
                }

                .dashboard-description {
                    font-size: 0.9rem;
                    color: #666;
                    margin-bottom: 15px;
                    font-style: italic;
                }

                .dashboard-number {
                    font-size: 2.5rem;
                    font-weight: 700;
                    color: #2575fc;
                }

                .dashboard-icon {
                    font-size: 3rem;
                    color: #6a11cb;
                    margin-bottom: 15px;
                }

                .btn-primary {
                    background-color: #2575fc;
                    border: none;
                }

                .btn-primary:hover {
                    background-color: #6a11cb;
                }
            </style>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card dashboard-card text-center p-4">
                        <div class="card-body">
                            <div class="dashboard-icon">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <h5 class="dashboard-title">Total Record Files</h5>
                            <div class="dashboard-description">Keep Track of all records in the system</div>
                            <div class="dashboard-number">{{ $allfiles }}</div>
                            <a href="{{ route('admin.files.index') }}" class="btn btn-primary mt-3">View Files</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card dashboard-card text-center p-4">
                        <div class="card-body">
                            <div class="dashboard-icon">
                                <i class="bi bi-folder"></i>
                            </div>
                            <h5 class="dashboard-title">Total Folders</h5>
                            <div class="dashboard-description">View and manage folder contents</div>
                            <div class="dashboard-number">{{ $folders }}</div>
                            <a href="{{ route('admin.folders.index') }}" class="btn btn-primary mt-3">View Folders</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap Icons CDN -->
            <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

        </div>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <input type="text" id="live-search" class="form-control" placeholder="Search files or folders...">
                </div>
            </div>
        </div>

        <div class="container mt-4" id="search-results"></div>

        <!-- File Details Modal -->
        <div class="modal fade" id="fileModal" tabindex="-1" aria-labelledby="fileModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="fileModalLabel">File Details</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5><i class="fas fa-file-alt text-primary me-2"></i><span id="modal-document-code"></span></h5>
                        <p><strong>Subject:</strong> <span id="modal-subject"></span></p>
                        <p><strong>Office:</strong> <span id="modal-office"></span></p>
                        <p><strong>Date:</strong> <span id="modal-date"></span></p>
                        <p><strong>remarks:</strong> <span id="modal-remarks"></span></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#live-search').on('keyup', function() {
                    let query = $(this).val();

                    if (query.length > 1) {
                        $.ajax({
                            url: "{{ route('admin.live.search') }}",
                            type: "GET",
                            data: {
                                query: query
                            },
                            success: function(response) {
                                let html = '';

                                if (response.files.length === 0 && response.folders.length === 0) {
                                    html =
                                        '<div class="alert alert-warning">No results found.</div>';
                                } else {
                                    if (response.files.length) {
                                        html +=
                                            `<h6 class="text-primary mb-3"><i class="fas fa-file-alt me-2"></i>Matching Files</h6><div class="row row-cols-1 row-cols-md-2 g-3 mb-4">`;
                                        response.files.forEach(file => {
                                            html += `
                                        <div class="col">
                                            <div class="card shadow-sm h-100 border-0 file-card"
                                                data-document-code="${file.document_code}"
                                                data-subject="${file.subject}"
                                                data-office="${file.originating_office}"
                                                data-date="${file.date}"
                                                data-remarks="${file.remarks || 'No remarks provided.'}">
                                                <div class="card-body">
                                                    <h5><i class="fas fa-file-alt text-primary me-2"></i>${file.document_code}</h5>
                                                    <p><strong>Subject:</strong> ${file.subject}</p>
                                                    <p><strong>Office:</strong> ${file.originating_office}</p>
                                                    <p><strong>Date:</strong> ${new Date(file.date).toLocaleDateString()}</p>
                                                    <a href="${file.file_url}" target="_blank" class="text-decoration-none">
                    <i class="fas fa-link me-1"></i>View File
                </a>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                        });
                                        html += `</div>`;
                                    }

                                    if (response.folders.length) {
                                        html +=
                                            `<h6 class="text-warning mb-3"><i class="fas fa-folder me-2"></i>Matching Folders</h6><div class="row row-cols-1 row-cols-md-2 g-3">`;
                                        response.folders.forEach(folder => {
                                            html += `
                                        <div class="col">
                                            <div class="card shadow-sm h-100 border-0">
                                                <div class="card-body">
                                                    <h5><i class="fas fa-folder text-warning me-2"></i>${folder.name}</h5>
                                                    <p>${folder.description}</p>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                        });
                                        html += `</div>`;
                                    }
                                }

                                $('#search-results').html(html);
                            }
                        });
                    } else {
                        $('#search-results').empty();
                    }
                });
            });
        </script>

        <script>
            $(document).on('click', '.file-card', function() {
                $('#modal-document-code').text($(this).data('document-code'));
                $('#modal-subject').text($(this).data('subject'));
                $('#modal-office').text($(this).data('office'));
                $('#modal-date').text(new Date($(this).data('date')).toLocaleDateString());
                $('#modal-remarks').text($(this).data('remarks'));

                const fileUrl = $(this).data('url');
                $('#modal-file-link').attr('href', fileUrl);
                $('#modal-file-button').attr('href', fileUrl);

                $('#fileModal').modal('show');
            });
        </script>

    @stop

</x-app-layout>
