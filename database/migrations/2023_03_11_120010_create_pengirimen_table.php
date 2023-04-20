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
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_id');
            $table->unsignedBigInteger('transportir_id');
            $table->date('tgl_kirim');
            $table->string('driver');
            $table->timestamps();
            $table->boolean('deleted')->default(false);

            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');
            $table->foreign('transportir_id')->references('id')->on('transportirs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};
