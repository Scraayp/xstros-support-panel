<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;


class LogsController extends Controller
{

    public function view(Request $request): View
    {
        // if (Auth::user()->role !== 'Admin') {
        //     abort(403);
        // }
        $query = Activity::with(['causer', 'subject'])->latest();
        
        // Apply activity type filter
        if ($request->has('filter') && !empty($request->filter)) {
            $query->where('description', $request->filter);
        }
        
        // Apply role filter
        if ($request->has('role') && !empty($request->role)) {
            $query->whereHas('causer', function($q) use ($request) {
                $q->where('role', $request->role);
            });
        }
        
        $logs = $query->paginate(10)->withQueryString();
        
        // Set selected filters for the dropdowns
        $selectedFilter = $request->filter ?? '';
        $selectedRole = $request->role ?? '';
        
        return view('logs.index', compact('logs', 'selectedFilter', 'selectedRole'));
    }

}
