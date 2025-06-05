<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogsController extends Controller
{
    //

    public function showLogs()
    {
        $logs = Activity::with('causer') // optional: get the user who made the change
            ->where('log_name', 'file')  // filter for logs related to "file"
            ->latest()
            ->get();

        return view('admin.logs.index', compact('logs'));
    }
}
