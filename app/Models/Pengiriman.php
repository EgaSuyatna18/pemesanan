<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengirimans';
    protected $guarded = [];

    public function purchase_order() {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function transportir() {
        return $this->belongsTo(Transportir::class);
    }
}
