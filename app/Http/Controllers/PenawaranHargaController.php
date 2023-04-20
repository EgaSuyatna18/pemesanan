<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenawaranHarga;
use App\Models\Order;
use App\Models\Produk;
use App\Models\OrderDone;
use App\Models\PenawaranHargaDone;

class PenawaranHargaController extends Controller
{
    function index() {
        return view('dashboard.penawaran_harga.index', [
            'title' => 'Penawaran Harga',
            'penawaranHargas' => PenawaranHarga::with('order.produk')->where('deleted', false)->paginate(10),
            'orders' => Order::where('deleted', false)->get()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'order_id' => 'required',
            'jangka_waktu' => 'required',
            'validasi_harga' => 'required|min:1',
            'syarat_pembayaran' => 'required',
        ]);

        $order = Order::where('id', $validated['order_id'])->first();

        OrderDone::create([
            'produk_id' => $order->produk_id,
            'customer_id' => $order->customer_id,
            'qty' => $order->qty,
            'penawaran_harga' => $order->penawaran_harga,
            'total_harga' => $order->total_harga,
            'tgl_order' => $order->tgl_order
        ]);

        $order->update(['deleted' => true]);

        PenawaranHarga::create($validated);

        return redirect('/penawaranharga')->with('notif', 'Berhasil menambahkan penawaran harga.');
    }

    function destroy(Request $request) {
        PenawaranHarga::where('id', $request->input('id'))->update(['deleted' => true]);
        return redirect('/penawaranharga')->with('notif', 'Berhasil menghapus penawaran harga.');
    }

    function update(Request $request) {
        $rules = [
            'jangka_waktu' => 'required',
            'validasi_harga' => 'required|min:1',
            'syarat_pembayaran' => 'required',
        ];

        if($request->input('order_id')) {
            $rules['order_id'] = 'required';
        }

        $validated = $request->validate($rules);

        if($request->input('order_id')) {
            Order::where('id', $request->input('order_old_id'))->update(['deleted' => false]);
            Order::where('id', $request->input('order_id'))->update(['deleted' => true]);
        }

        PenawaranHarga::where('id', $request->input('id'))->update($validated);

        return redirect('/penawaranharga')->with('notif', 'Berhasil mengubah penawaran harga.');
    }

    function laporan() {
        return view('dashboard.laporan.penawaran_harga', [
            'title' => 'Laporan Penawaran Harga',
            'penawaranHargas' => PenawaranHargaDone::with('order')->get()
        ]);
    }
}
