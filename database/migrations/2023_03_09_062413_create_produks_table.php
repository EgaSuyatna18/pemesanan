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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['Barang', 'Jasa']);
            $table->text('deskripsi');
            $table->integer('stok');
            $table->enum('unit', ['PCS', 'LOT', 'SET', 'EA', 'UN', 'M', 'DLL']);
            $table->integer('harga');
            $table->timestamps();
            $table->boolean('deleted')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
