<?php

namespace App\Http\Controllers;

use App\Models\SalesItem;
use Illuminate\Http\Request;

class AddToSale extends Controller
{
    public function addToSale(Request $request)
    {
        $productName = $request->input('productName');
        $price = $request->input('price');
        $quantity = $request->input('quantity');

        // Simpan data ke dalam tabel sale_items
        $saleItem = new SalesItem();
        $saleItem->productName = $productName;
        $saleItem->price = $price;
        $saleItem->quantity = $quantity;
        $saleItem->save();

        return response()->json(['message' => 'Item added to sale'], 200);
    }
}
