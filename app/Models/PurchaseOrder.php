<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function penawaran_harga() {
        return $this->belongsTo(PenawaranHarga::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
