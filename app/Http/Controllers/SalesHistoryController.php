<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sales;


class SalesHistoryController extends Controller
{
    public function checkout()
    {
        $data = Sales::all();
        return view('dashboardAdmin', compact('data'));
    }

    public function checkoutdata(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:50'],
            'total_price' => ['required'],
            'total_quantity' => ['required'],
        ]);

        try {
            $sales = new Sales();
            $sales->name = $request->input('name');
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
