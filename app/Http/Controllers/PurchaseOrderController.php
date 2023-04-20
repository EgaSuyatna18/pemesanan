<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use App\Models\PenawaranHarga;
use App\Models\PenawaranHargaDone;
use App\Models\Transportir;
use App\Models\PurchaseOrderDone;
use App\Models\Pengiriman;

class PurchaseOrderController extends Controller
{
    function index() {
        return view('dashboard.purchase_order.index', [
            'title' => 'Purchase Order',
            'purchaseOrders' => PurchaseOrder::with(['penawaran_harga', 'user'])->where('deleted', false)->paginate(10),
            'penawaranHargas' => PenawaranHarga::where('deleted', false)->get(),
            'transportirs' => Transportir::where('deleted', false)->get()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'penawaran_harga_id' => 'required',
            'keterangan' => 'required',
            'tgl_po' => 'required'
        ]);

        $penawaranHarga = PenawaranHarga::where('id', $validated['penawaran_harga_id'])->first();

        PenawaranHargaDone::create([
            'order_id' => $penawaranHarga->order_id,
            'jangka_waktu' => $penawaranHarga->jangka_waktu,
            'validasi_harga' => $penawaranHarga->validasi_harga,
            'syarat_pembayaran' => $penawaranHarga->syarat_pembayaran,
        ]);

        $penawaranHarga->update(['deleted' => true]);

        $validated['user_id'] = auth()->user()->id;

        PurchaseOrder::create($validated);

        return redirect('/purchaseorder')->with('notif', 'Berhasil menambahkan purchase order.');
    }

    function destroy(Request $request) {
        PurchaseOrder::where('id', $request->input('id'))->update(['deleted' => true]);
        return redirect('/purchaseorder')->with('notif', 'Berhasil menghapus purchase order.');
    }

    function update(Request $request) {
        $rules = [
            'keterangan' => 'required',
            'tgl_po' => 'required'
        ];

        if($request->input('penawaran_harga_id')) {
            $rules['penawaran_harga_id'] = 'required';
        }

        $validated = $request->validate($rules);

        if($request->input('penawaran_harga_id')) {
            PenawaranHarga::where('id', $request->input('penawaran_harga_old_id'))->update(['deleted' => false]);
            PenawaranHarga::where('id', $request->input('penawaran_harga_id'))->update(['deleted' => true]);
        }

        PurchaseOrder::where('id', $request->input('id'))->update($validated);

        return redirect('/purchaseorder')->with('notif', 'Berhasil mengubah purchase order.');
    }

    function kirim(Request $request) {
        $validated = $request->validate([
            'purchase_order_id' => 'required',
            'transportir_id' => 'required',
            'tgl_kirim' => 'required',
            'driver' => 'required'
        ]);

        $po = PurchaseOrder::where('id', $validated['purchase_order_id'])->first();

        PurchaseOrderDone::create([
            'penawaran_harga_id' => $po->penawaran_harga_id,
            'user_id' => $po->user_id,
            'keterangan' => $po->keterangan,
            'tgl_po' => $po->tgl_po,
        ]);

        $po->update(['deleted' => true]);

        Pengiriman::create($validated);

        return redirect('/purchaseorder/pengiriman')->with('notif', 'Berhasil menambah pengiriman.');
    }

    function pengiriman() {
        return view('dashboard.purchase_order.pengiriman', [
            'title' => 'Pengiriman',
            'pengirimans' => Pengiriman::with('purchase_order.penawaran_harga.order.customer')->paginate(10)
        ]);
    }

    function laporan() {
        return view('dashboard.laporan.purchase_order', [
            'title' => 'Laporan Purchase Order',
            'purchaseOrders' => PurchaseOrderDone::with(['penawaran_harga', 'user'])->get()
        ]);
    }
}
