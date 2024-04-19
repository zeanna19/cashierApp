<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $data = Barang::all();
        return view('dashboardAdmin', compact('data'));
    }

    public function mainMenu()
    {
        $data = Barang::all();
        return view('mainMenu', compact('data'));
    }
    public function addProduct()
    {
        return view('AddProduct');
    }

    public function insertdata(Request $request)
    {
        Barang::create($request->all());
        return redirect()->route('dashboardAdmin');
    }
    public function editdata($id)
    {
        $data = Barang::find($id);

        return view('edit', compact('data'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = Barang::find($id);
        $data->update($request->all());
        return redirect()->route('dashboardAdmin');
    }

    public function delete($id)
    {
        $data = Barang::find($id);
        $data->delete();
        return redirect()->route('dashboardAdmin');
    }

    public function pinjamBarang($id)
    {
        $barang = Barang::find($id);
        if ($barang->stokBarang > 0) {
            $barang->stokBarang--;
            $barang->save();
            return redirect()->back()->with('success', 'Barang berhasil dipinjam.');
        } else {
            return redirect()->back()->with('error', 'Barang habis.');
        }
    }

    public function kembalikanBarang($id)
    {
        $barang = Barang::find($id);
        if ($barang->stokBarang < $barang->jumlahBarang) {
            $barang->stokBarang++;
            $barang->save();
            return redirect()->back()->with('success', 'Barang berhasil dikembalikan.');
        } else {
            return redirect()->back()->with('error', 'Stok barang sudah penuh.');
        }
    }
}
