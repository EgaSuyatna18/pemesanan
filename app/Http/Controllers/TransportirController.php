<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transportir;

class TransportirController extends Controller
{
    function index() {
        return view('dashboard.transportir.index', [
            'title' => 'Transportir',
            'transportirs' => Transportir::where('deleted', false)->paginate(10)
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'kendaraan' => 'required',
            'no_polisi' => 'required',
            'keterangan' => 'required'
        ]);

        Transportir::create($validated);

        return redirect('/transportir')->with('notif', 'Berhasil menambahkan transportir.');
    }

    function destroy(Request $request) {
        Transportir::where('id', $request->input('id'))->update(['deleted' => true]);
        return redirect('/transportir')->with('notif', 'Berhasil menghapus transportir.');
    }

    function update(Request $request) {
        $validated = $request->validate([
            'kendaraan' => 'required',
            'no_polisi' => 'required',
            'keterangan' => 'required'
        ]);

        Transportir::where('id', $request->input('id'))->update($validated);

        return redirect('/transportir')->with('notif', 'Berhasil mengubah transportir.');
    }
}
