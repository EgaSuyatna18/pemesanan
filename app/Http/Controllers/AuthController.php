<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login() {
        return view('auth.login');
    }

    function tryLogin(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('dashboard');
        }
 
        return back()->withErrors([
            'failedAuth' => 'Email atau Password salah!',
        ])->onlyInput('email');
    }

    function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    function profil() {
        return view('dashboard.profil', [
            'title' => 'Profil',
            'user' => auth()->user()
        ]);
    }

    function ubahProfil(Request $request) {
        $rules = [
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

        User::where('id', auth()->user()->id)->update($validated);

        return redirect('/profil')->with('notif', 'Berhasil mengubah profile.');
    }
}
