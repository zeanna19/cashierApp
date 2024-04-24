<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'penjualan';

    protected $fillable = ['name', 'total_quantity', 'total_price'];
}
