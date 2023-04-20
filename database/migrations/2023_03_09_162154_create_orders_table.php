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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('produk_id');
            $table->unsignedBigInteger('customer_id');
            $table->integer('qty');
            $table->integer('penawaran_harga');
            $table->integer('total_harga');
            $table->date('tgl_order');
            $table->timestamps();
            $table->boolean('deleted')->default(false);

            $table->foreign('produk_id')->references('id')->on('produks');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
