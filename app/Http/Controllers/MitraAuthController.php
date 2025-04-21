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
        return view('mitra.LoginMitra');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/DashboardMitra');
        }

        return back()->withErrors(['login_error' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/LoginMitra');
    }

    public function showAkun()
    {
        $user = Auth::user();
        return view('mitra.DataAkun', compact('user'));
    }

    public function editAkun()
    {
        $user = Auth::user();
        return view('mitra.EditAkun', compact('user'));
    }

    public function updateAkun(Request $request)
    {
        $request->validate([
            'username_baru' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();

        // Update the user data
        $user->username = $request->username_baru;
        $user->alamat = $request->alamat;
        $user->no_hp = $request->no_hp;
        $user->email = $request->email;

        // Optional password update
        if ($request->filled('password_lama') && $request->filled('password_baru')) {
            $request->validate([
                'password_lama' => 'required|string',
                'password_baru' => 'required|string|min:8',
            ]);

            // Verify the old password
            if (!Hash::check($request->password_lama, $user->password)) {
                return back()->withErrors(['password_lama' => 'Password lama tidak sesuai']);
            }

            $user->password = Hash::make($request->password_baru);
        }

        $user->save();

        return redirect()->route('mitra.DataAkun')->with('success', 'Akun berhasil diperbarui');
    }
}
