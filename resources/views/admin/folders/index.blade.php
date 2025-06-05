<x-app-layout>
    <div class="container">
        <h1>Folders</h1>
        <a href="{{ route('admin.folders.create') }}" class="btn btn-primary mb-3">Create New Folder</a>
        @if ($folders->count())
            <div class="row">
                @foreach ($folders as $folder)
                    <div class="col-md-3 col-sm-4 col-6 mb-4">
                        <div class="card text-center">
                            <a href="{{ route('admin.folders.show', $folder->id) }}"
                                style="text-decoration:none; color:inherit;">
                                <div class="card-body">
                                    <i class="fas fa-folder fa-4x text-warning mb-2"></i>
                                    <h5 class="card-title">{{ $folder->name }}</h5>
                                    <small class="text-muted">{{ $folder->created_at->format('Y-m-d') }}</small>
                                </div>
                            </a>
                            <div class="card-footer p-2">
                                <a href="{{ route('admin.folders.edit', $folder->id) }}"
                                    class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.folders.destroy', $folder->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this folder?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No folders found.</p>
        @endif
    </div>
    {{-- Font Awesome CDN --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-app-layout>
