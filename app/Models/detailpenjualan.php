<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    use HasFactory;

    protected $table = 'detailpenjualan';

    protected $guarded = [];

    public function penjualan()
    {
        return $this->belongsTo(Sales::class, 'penjualan_id');
    }

    public function produk()
    {
        return $this->belongsTo(Barang::class, 'produk_id');
    }
}
