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
        Schema::create('order_dones', function (Blueprint $table) {
            $table->id();
            $table->integer('produk_id');
            $table->integer('customer_id');
            $table->integer('qty');
            $table->integer('penawaran_harga');
            $table->integer('total_harga');
            $table->date('tgl_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_dones');
    }
};
