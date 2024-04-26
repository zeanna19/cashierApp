<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data = Barang::all();
        $kategori = Kategori::all();
        return view('mainMenu', compact('data', 'kategori'));
    }
}
