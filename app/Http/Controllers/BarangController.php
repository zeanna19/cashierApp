<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index()
    {
        $data = Barang::all();
        $kategori = Kategori::all();

        return view('itemList', compact('data', 'kategori'));
    }

    public function dashboard()
    {
        $data = Barang::all();
        $kategori = Kategori::all();

        return view('dashboard', compact('data', 'kategori'));
    }
    public function mainMenu()
    {

        $data = Barang::all();
        $kategori = Kategori::all();

        return view('mainMenu', compact('data', 'kategori'));
    }
    public function addProduct()
    {
        $data = Barang::all();
        $kategori = Kategori::all();

        return view('AddProduct', compact('data', 'kategori'));
    }

    public function insertdata(Request $request)
    {
        $kategori = Kategori::findOrFail($request->jenis);

        $foto = $request->file('foto');
        $path = $foto->store('public/image');
        $nama_foto = basename($path);

        Barang::create([
            'nama' => $request->nama,
            'jenis' => $kategori->jenis,
            'harga' => $request->harga,
            'foto' => $nama_foto,
            'kategori_id' => $kategori->id,
        ]);

        return redirect()->route('itemList');
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

        return redirect()->route('itemList');
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
        return redirect()->route('itemList');
    }

    public function deleteproduct($id)
    {
        $product = Barang::findOrFail($id);
        if (!empty($product->foto)) {
            Storage::disk('public')->delete('image/' . $product->foto);
        }
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus');
    }

    public function loadBarangByKategori(Request $request)
    {
        $kategoriId = $request->input('kategori_id');

        $barang = Barang::where('kategori_id', $kategoriId)->get();

        return response()->json($barang);
    }
}
