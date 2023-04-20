<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    function index() {
        return view('dashboard.produk.index', [
            'title' => 'Produk',
            'produks' => Produk::where('deleted', false)->paginate(10)
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'kategori' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|min:1',
            'unit' => 'required',
            'harga' => 'required|min:1'
        ]);

        Produk::create($validated);

        return redirect('/produk')->with('notif', 'Berhasil menambahkan produk.');
    }

    function destroy(Request $request) {
        Produk::where('id', $request->input('id'))->update(['deleted' => true]);
        return redirect('/produk')->with('notif', 'Berhasil menghapus produk.');
    }

    function update(Request $request) {
        $validated = $request->validate([
            'kategori' => 'required',
            'deskripsi' => 'required',
            'stok' => 'required|min:1',
            'unit' => 'required',
            'harga' => 'required|min:1'
        ]);

        Produk::where('id', $request->input('id'))->update($validated);

        return redirect('/produk')->with('notif', 'Berhasil mengubah produk.');
    }
}
