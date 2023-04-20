<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function index() {
        return view('dashboard.user.index', [
            'title' => 'User',
            'users' => User::where('deleted', false)->paginate(10)
        ]);
    }

    function store(Request $request) {
        $validated = $request->validate([
            'role' => 'required',
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:255',
            'password' => 'required|min:3|max:16',
            'password_confirmation' => 'required|same:password'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect('/user')->with('notif', 'Berhasil menambahkan user.');
    }

    function destroy(Request $request) {
        User::where('id', $request->input('id'))->update(['deleted' => true]);
        return redirect('/user')->with('notif', 'Berhasil menghapus user.');
    }

    function update(Request $request) {
        $rules = [
            'role' => 'required',
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|max:255',
        ];
        
        if($request->input('password')) {
            $rules['password'] = 'required|min:3|max:16';
        }

        $validated = $request->validate($rules);

        if($request->input('password')) {
            $validated['password'] = Hash::make($validated['password']);
        }

        User::where('id', $request->input('id'))->update($validated);

        return redirect('/user')->with('notif', 'Berhasil mengubah user.');
    }
}
