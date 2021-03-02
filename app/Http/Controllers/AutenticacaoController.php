<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AutenticacaoController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function finalizarLogin(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ])->validate();

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('adm');
        }else{
            return redirect()->back();
        }
    }

    public function cadastro()
    {
        return view('auth.register');
    }

    public function finalizarCadastro(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('adm');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
