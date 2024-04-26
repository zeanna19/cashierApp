<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required',
            'level' => 'required',
        ]);

        if (Auth::attempt($attributes)) {
            session()->regenerate();
            if (auth()->user()->level == 'admin') {
                return redirect()->route('dashboard')->with(['success' => 'You are logged in.']);
            } else {
                return redirect()->route('mainMenu')->with(['success' => 'You are logged in.']);
            }
        } else {
            if ($attributes['level'] === 'admin' || $attributes['level'] === 'petugas') {
                return back()->withErrors(['email' => 'Invalid email or password or level']);
            } else {
                return back()->withErrors(['email' => 'Invalid email or password']);
            }
        }
    }


    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success' => 'You\'ve been logged out.']);
    }
}
