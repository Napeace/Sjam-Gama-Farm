<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('loginmitra'); // nanti kita buat file ini
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/DashboardMitra');
        }

        return back()->withErrors(['login_error' => 'Username atau password salah']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/LoginMitra');
    }
}

