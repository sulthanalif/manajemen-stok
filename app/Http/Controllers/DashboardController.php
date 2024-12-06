<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $requests = ModelsRequest::all();
        return view('dashboard', compact('requests'));
    }
}
