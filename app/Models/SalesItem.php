<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesItem extends Model
{
    protected $table = 'sale_items';

    protected $fillable = ['sale_id', 'productName', 'price', 'quantity'];
}
