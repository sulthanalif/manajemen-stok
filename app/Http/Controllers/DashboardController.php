<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as ModelsRequest;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles[0]->name == 'Chef') {
            $requests = ModelsRequest::where('user_id', Auth::user()->id)->get();
            $allRequestCount = $requests->count();
            $requestAccCount = $requests->whereNotIn('status', ['Pending', 'Rejected'])->count();
            $requestPendingCount = $requests->whereIn('status', 'Pending')->count();
            $requestRejectedCount = $requests->whereIn('status', 'Rejected')->count();
        } else {
            $requests = ModelsRequest::all();
            $allRequestCount = $requests->count();
            $requestAccCount = $requests->whereNotIn('status', ['Pending', 'Rejected'])->count();
            $requestPendingCount = $requests->whereIn('status', ['Pending'])->count();
            $requestRejectedCount = $requests->whereIn('status', ['Rejected'])->count();
        }




        return view('dashboard', compact('requests', 'allRequestCount', 'requestAccCount', 'requestPendingCount', 'requestRejectedCount'));
    }
}
