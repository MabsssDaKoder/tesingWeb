<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show login page
    public function showLogin() {
        return view('login');
    }

    // Handle login
    public function login(Request $request) {
        $request->validate([
            'email'    => 'required',
            'password' => 'required'
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            $role = Auth::user()->role;

            if ($role === 'admin') {
                return redirect('/admin/shop');
            } elseif ($role === 'staff') {
                return redirect('/staff/new-laundry');
            }
        }

        return back()->withErrors([
            'email' => 'Invalid email or password!'
        ])->withInput();
    }

    // Logout
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}