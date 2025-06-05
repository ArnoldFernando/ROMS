<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Folder') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.folders.update', $folder->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Folder Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name', $folder->name) }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description (optional)</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $folder->description) }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Folder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
