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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penawaran_harga_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('keterangan', ['Lunas', 'Belum Lunas']);
            $table->date('tgl_po');
            $table->timestamps();
            $table->boolean('deleted')->default(false);

            $table->foreign('penawaran_harga_id')->references('id')->on('penawaran_hargas');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
