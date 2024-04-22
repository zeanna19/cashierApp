<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;
use App\Models\Barang;


class SalesHistoryController extends Controller
{
    public function checkout()
    {
        $data = Sales::all();
        return view('dashboardAdmin', compact('data'));
    }

    public function checkoutdata(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50'],
            'jumlahBayar' => ['required', 'numeric'],
            'total_price' => ['required', 'numeric'],
            'total_quantity' => ['required', 'integer'],
        ]);

        try {
            $status = $request->jumlahBayar >= $request->total_price ? 'lunas' : 'belum lunas';
            $kembalian = $request->jumlahBayar - $request->total_price;
            $sales = Barang::find('nama,stok');
            $sales = new Sales();
            $sales->name = $request->input('name');
            $sales->jumlahBayar = $request->input('jumlahBayar');
            $sales->status = $status;
            $sales->total_price = $request->input('total_price');
            $sales->total_quantity = $request->input('total_quantity');
            $sales->save();


            return response()->json(['message' => 'Data berhasil disimpan'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data'], 500);
        }
    }

    public function histori()
    {
        $data = Sales::all();
        return view('histori', compact('data'));
    }
    public function apus($id)
    {
        $data = Sales::find($id);
        $data->delete();
        return redirect()->route('histori');
    }
}
