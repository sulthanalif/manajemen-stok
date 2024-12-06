<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('master.users', compact('users', 'roles'));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        return redirect()->route('master.users');
    }
}
