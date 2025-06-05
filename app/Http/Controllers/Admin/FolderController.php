<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $folders = \App\Models\Folder::where('user_id', auth()->id())->get(); // Fetch folders for the authenticated user
        return view('admin.folders.index', compact('folders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.folders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        $folder = new \App\Models\Folder();
        $folder->name = $request->input('name');
        $folder->description = $request->input('description');
        $folder->user_id = auth()->id(); // Assuming the user is authenticated
        $folder->save();
        return redirect()->back()->with('success', 'Folder created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $folder = Folder::with('files')->findOrFail($id);
        return view('admin.folders.show', compact('folder'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $folder = \App\Models\Folder::findOrFail($id); // Fetch the folder by ID
        return view('admin.folders.edit', compact('folder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);
        $folder = \App\Models\Folder::findOrFail($id);
        $folder->name = $request->input('name');
        $folder->description = $request->input('description');
        $folder->save();
        return redirect()->back()->with('success', 'Folder updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
