<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        return view('static-sign-up');
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'level' => 'required|in:admin,petugas',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'Level' => $request->level,
        ]);

        return redirect()->route('tables')->with('success', 'User created successfully.');
    }

    public function showUsers()
    {
        $users = User::all();
        return view('tables', compact('users'));
    }

    public function create()
    {
        return view('static-sign-up');
    }
}
