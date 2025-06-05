<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
