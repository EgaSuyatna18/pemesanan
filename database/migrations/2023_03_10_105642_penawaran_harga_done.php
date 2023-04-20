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
        Schema::create('penawaran_harga_dones', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->date('jangka_waktu');
            $table->integer('validasi_harga');
            $table->string('syarat_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawaran_harga_dones');
    }
};
