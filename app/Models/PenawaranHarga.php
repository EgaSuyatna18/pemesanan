<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenawaranHarga extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    public function produk() {
        return $this->belongsTo(Produk::class);
    }
}
