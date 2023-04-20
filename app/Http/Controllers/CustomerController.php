<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    function index() {
        return view('dashboard.customer.index', [
            'title' => 'Cutomer',
            'customers' => Customer::where('deleted', false)->paginate(10)
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'alamat' => 'required'
        ]);

        Customer::create($validated);

        return redirect('/customer')->with('notif', 'Berhasil menambahkan customer.');
    }

    function destroy(Request $request) {
        Customer::where('id', $request->input('id'))->update(['deleted' => true]);
        return redirect('/customer')->with('notif', 'Berhasil menghapus customer.');
    }

    function update(Request $request) {
        $validated = $request->validate([
            'nama' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'alamat' => 'required'
        ]);

        Customer::where('id', $request->input('id'))->update($validated);

        return redirect('/customer')->with('notif', 'Berhasil mengubah customer.');
    }
}
