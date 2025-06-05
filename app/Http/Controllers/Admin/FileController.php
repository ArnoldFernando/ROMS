<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArchivedFile;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $files = File::all(); // Fetch files for the authenticated user
        return view('admin.files.index', compact('files'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $folderId = $request->folder_id;
        return view('admin.files.create', compact('folderId'));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'file.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg', // customize as needed
        ]);

        foreach ($request->file('file') as $uploadedFile) {
            $filePath = $uploadedFile->store('uploads/files', 'public'); // or change disk as needed

            File::create([
                'document_code' => $request->document_code,
                'subject' => $request->subject,
                'originating_office' => $request->originating_office,
                'remarks' => $request->remarks,
                'file' => $filePath,
                'date' => $request->date,
                'folder_id' => $request->folder_id,
                'user_id' => auth()->id(),
            ]);
        }

        return redirect()->back()->with('success', 'File(s) uploaded successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $file = File::with('folder')->findOrFail($id);
        $folder = $file->folder; // single folder model
        return view('admin.files.edit', compact('file', 'folder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $file = File::findOrFail($id);
        $request->validate([
            'subject' => 'required|string|max:255',
            'file.*' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg', // customize as needed
        ]);
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($file->file) {
                \Storage::disk('public')->delete($file->file);
            }
            $filePath = $request->file('file')->store('uploads/files', 'public'); // or change disk as needed
            $file->file = $filePath;
        }
        $file->document_code = $request->document_code;
        $file->subject = $request->subject;
        $file->originating_office = $request->originating_office;
        $file->remarks = $request->remarks;
        $file->date = $request->date;
        $file->folder_id = $request->folder_id;
        $file->user_id = auth()->id();
        $file->save();
        return redirect()->route('admin.folders.show', $file->folder_id)
            ->with('success', 'File updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function archive($id)
    {
        $file = File::findOrFail($id);

        // Copy to archive
        ArchivedFile::create($file->only([
            'document_code',
            'subject',
            'originating_office',
            'remarks',
            'file',
            'date',
            'folder_id',
            'user_id'
        ]));

        // Remove from files table
        $file->delete();

        return redirect()->back()->with('success', 'File archived successfully.');
    }
}
