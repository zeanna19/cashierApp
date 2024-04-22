<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SignUpController extends Controller
{
    public function create()
    {

        return view('static-sign-up');
    }

    public function staticproses()
    {
        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'level' => ['required', Rule::unique('admin', 'petugas')],
            'agreement' => ['accepted']
        ]);
        $attributes['password'] = bcrypt($attributes['password']);



        session()->flash('success', 'Your account has been created.');
        $user = User::create($attributes);
        Auth::login($user);
        return redirect('/tables');
    }

    public function tables()
    {
        $data = User::all();
        return view('tables', compact('data'));
    }
    public function inputdata(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:4', 'max:20'],
            'email' => ['required', 'min:5', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'level' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($validatedData['password']),
            'level' => $request->input('level'),
        ]);


        return redirect()->route('tables');
    }

    public function hapus($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->route('tables');
    }
}
