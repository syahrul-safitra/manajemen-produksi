<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    public function auth(Request $request) {
        
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:20'
        ]);


        if (Auth::attempt($credentials)) {
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Failed');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('login');
    }

}


