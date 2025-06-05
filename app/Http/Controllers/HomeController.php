<?php

namespace App\Http\Controllers;

use App\Models\ArchivedFile;
use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = $request->input('query');

        $allfiles = File::count();
        $archivedfiles = ArchivedFile::count();
        $folders = Folder::count();

        $searchResults = null;

        if ($query) {
            $files = File::with('folder')->where(function ($q) use ($query) {
                $q->where('document_code', 'like', "%$query%")
                    ->orWhere('subject', 'like', "%$query%")
                    ->orWhere('originating_office', 'like', "%$query%")
                    ->orWhere('remarks', 'like', "%$query%")
                    ->orWhere('file', 'like', "%$query%")
                    ->orWhere('date', 'like', "%$query%");
            })->get();

            $matchedFolders = Folder::where(function ($q) use ($query) {
                $q->where('name', 'like', "%$query%")
                    ->orWhere('description', 'like', "%$query%");
            })->get();

            $searchResults = compact('files', 'matchedFolders', 'query');
        }

        return view('admin.dashboard', compact('allfiles', 'archivedfiles', 'folders', 'searchResults'));
    }


    public function liveSearch(Request $request)
    {
        $query = $request->get('query');

        // Get matching files
        $files = File::with('folder')->where(function ($q) use ($query) {
            $q->where('document_code', 'like', "%$query%")
                ->orWhere('subject', 'like', "%$query%")
                ->orWhere('originating_office', 'like', "%$query%")
                ->orWhere('remarks', 'like', "%$query%")
                ->orWhere('file', 'like', "%$query%")
                ->orWhere('date', 'like', "%$query%");
        })->get();

        // Add file_url to each file
        foreach ($files as $file) {
            $file->file_url = asset('storage/' . $file->file);
            // assuming 'file' is the actual filename
        }

        // Get matching folders
        $matchedFolders = Folder::where(function ($q) use ($query) {
            $q->where('name', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%");
        })->get();

        return response()->json([
            'files' => $files,
            'folders' => $matchedFolders
        ]);
    }
}
