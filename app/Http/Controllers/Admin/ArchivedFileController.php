<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchivedFile;
use App\Models\File;
use Illuminate\Http\Request;

class ArchivedFileController extends Controller
{
    //
    public function index()
    {
        $files = ArchivedFile::all(); // Fetch archived files for the authenticated user
        return view('admin.archived.index', compact('files'));
    }
    public function restore($id)
    {
        $archived = ArchivedFile::findOrFail($id);

        // Restore to active files
        File::create($archived->only([
            'document_code',
            'subject',
            'originating_office',
            'remarks',
            'file',
            'date',
            'folder_id',
            'user_id'
        ]));

        // Remove from archive
        $archived->delete();

        return redirect()->back()->with('success', 'File restored successfully.');
    }
}
