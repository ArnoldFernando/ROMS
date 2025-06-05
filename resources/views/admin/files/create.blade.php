<x-app-layout>
    <form action="{{ route('admin.files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="folder_id" value="{{ $folderId }}">

        <div class="mb-3">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>File</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Remarks</label>
            <input type="text" name="remarks" class="form-control">
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Upload File</button>
    </form>

</x-app-layout>>
