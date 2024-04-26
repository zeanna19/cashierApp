<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

function console_log($data)
{
    // Convert the data to a string if it's an array or object
    if (is_array($data) || is_object($data)) {
        $data = print_r($data, true);
    }
    // Write the data to the error log
    error_log($data);
}

class HomeController extends Controller
{
    public function home()
    {
        console_log('kategori mainMenu');
        $data = Barang::all();
        $kategori = Kategori::all();
        return view('mainMenu', compact('data', 'kategori'));
    }
}
