<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDone extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function produk() {
        return $this->belongsTo(Produk::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
