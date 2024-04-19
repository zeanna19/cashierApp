<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data = Barang::all();
        return view('mainMenu', compact('data'));
    }
}
