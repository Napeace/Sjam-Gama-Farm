<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class MitraAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('mitra.login-mitra');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-mitra');
        }

        return back()->withErrors(['login_error' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login-mitra');
    }

    public function showAkun()
    {
        $user = Auth::user();
        return view('mitra.data-akun', compact('user'));
    }

    public function editAkun()
    {
        $user = Auth::user();
        return view('mitra.edit-akun', compact('user'));
    }

    public function updateAkun(Request $request)
    {
        $request->validate([
            'username_baru' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|max:255',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Use direct property assignment
        $user->username = $request->username_baru;
        $user->alamat = $request->alamat;
        $user->no_hp = $request->no_hp;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('mitra.DataAkun')->with('success', 'Akun berhasil diperbarui');
    }
}
