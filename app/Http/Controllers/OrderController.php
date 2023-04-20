<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Produk;
use App\Models\Customer;
use App\Models\OrderDone;

class OrderController extends Controller
{
    function index() {
        return view('dashboard.order.index', [
            'title' => 'Order',
            'orders' => Order::with(['produk', 'customer'])->where('deleted', false)->paginate(10),
            'produks' => Produk::where('deleted', false)->get(),
            'customers' => Customer::where('deleted', false)->get()
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'produk_id' => 'required',
            'customer_id' => 'required',
            'qty' => 'required|min:1',
            'penawaran_harga' => 'required|min:1',
            'tgl_order' => 'required'
        ]);

        $produk = Produk::where('id', $validated['produk_id'])->first();

        if($produk->stok < $validated['qty']) {
            return redirect('/order')->with('notif', 'Stok produk tidak cukup!');
        }

        $produk->decrement('stok', $validated['qty']);

        $validated['total_harga'] = $validated['qty'] * $validated['penawaran_harga'];

        Order::create($validated);

        return redirect('/order')->with('notif', 'Berhasil menambahkan order.');
    }

    function destroy(Request $request) {
        Order::where('id', $request->input('id'))->update(['deleted' => true]);
        return redirect('/order')->with('notif', 'Berhasil menghapus order.');
    }

    function update(Request $request) {
        $validated = $request->validate([
            'produk_id' => 'required',
            'customer_id' => 'required',
            'qty' => 'required|min:1',
            'penawaran_harga' => 'required|min:1',
            'tgl_order' => 'required'
        ]);

        Order::where('id', $request->input('id'))->update($validated);

        return redirect('/order')->with('notif', 'Berhasil mengubah order.');
    }

    function laporan() {
        return view('dashboard.laporan.order', [
            'title' => 'Laporan Order',
            'orders' => OrderDone::with(['produk', 'customer'])->get()
        ]);
    }
}
