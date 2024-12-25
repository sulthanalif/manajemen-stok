<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SwitchRoleController extends Controller
{
    public function __invoke(Request $request)
    {
        // Auth::user()->switchRole($request->role);
        // return redirect()->route('home');
    }
}
