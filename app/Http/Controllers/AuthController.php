<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    public function showRegisterPage()
    {
        return view('pages.auth.register');
    }

    public function showLoginPage()
    {
        return view('pages.auth.login');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:32|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:5|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        redirect('/');
        $this->login($request);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect('/')->with('status', 'Successfully logged in ');
        }

        return redirect('/login')->withErrors('Invalid credentials!');
    }

    public function logOut()
    {
        FacadesSession::flush();
        Auth::logout();

        return redirect('/login')->with('status', 'You are logged out');
    }
}
