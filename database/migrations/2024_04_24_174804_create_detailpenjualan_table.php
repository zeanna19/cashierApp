<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detailpenjualan', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlahproduk');
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
            $table->unsignedBigInteger('penjualan_id')->nullable();
            $table->foreign('penjualan_id')->references('id')->on('penjualan');
            $table->unsignedBigInteger('produk_id')->nullable();
            $table->foreign('produk_id')->references('id')->on('produk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailpenjualan');
    }
};
