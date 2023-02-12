<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate(
            [
                'email'  => 'required',
                'password'  => 'required|min:6',
            ],
            [
                'email.required' => "Email Tidak Boleh Kosong",
                'password.required' => "Password Tidak Boleh Kosong",
            ]
        );

        $credentials = $request->only('email', 'password');
        // $credentials['role'] = 'admin';

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Ooppss Wrongs',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
