<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;


class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::all();
        return view('dashboardAdmin', compact('data'));
    }

    public function addKategori()
    {
        return view('AddKategori');
    }

    public function insertKategori(Request $request)
    {

        Kategori::create([
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('dashboardAdmin');
    }
}
