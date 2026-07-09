<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->filled('remember'))){
            $request->session()->regenerate();
            $user = Auth::user();

            if($user->role === 'pembeli'){
                return redirect('/home');
            } elseif($user->role === 'penjual'){
                return redirect('/seller/dashboard');
            } else {
                return redirect('/dashboard');
            }
        }
        Alert::error('Email Atau Password Salah');

        return back()->with('error', 'Email atau password salah');
    }

    function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:50',
            'password' => 'required|max:50|min:8',
            'confirm_password' => 'required|max:50|min:8|same:password',
        ], [
            'password.min' => 'Password harus minimal 8 karakter',
            'confirm_password.min' => 'Konfirmasi password harus minimal 8 karakter',
            'confirm_password.same' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            Alert::error('Registrasi Gagal', $validator->errors()->first());
            return back()->withInput();
        }

        $request['status'] = 'verify';
        $request['role'] = 'pembeli';
        $user = User::create($request->all());
        Auth::login($user);
        return redirect('/verify');
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
