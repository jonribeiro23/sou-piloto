<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::check()) return redirect('/dashboard');
        return view('index');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ], [
            'email.required'    => 'Informe o email',
            'password.required' => 'Informe a senha'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            return redirect('/dashboard');
        }else{
            return redirect()->back()->with('danger', 'Email ou senha inválidos.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}