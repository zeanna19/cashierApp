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
        $foto = $request->file('foto');
        $path = $foto->store('public/image');

        $nama_foto = basename($path);

        Barang::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'harga' => $request->harga,
            'jumlah' => $request->jumlah,
            'stok' => $request->stok,
            'foto' => $nama_foto,
        ]);

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

    public function deleteproduct($id)
    {
        $product = Barang::findOrFail($id);

        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
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
