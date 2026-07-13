<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email|max:50',
            'password' => 'required|max:50',
        ]);

        $credentials = $request->only('email', 'password');
        
        // Check if credentials are valid without logging in
        $user = User::where('email', $request->email)->first();
        
        if (!$user || !password_verify($request->password, $user->password)) {
            Alert::error('Email Atau Password Salah');
            return back()->with('error', 'Email atau password salah');
        }

        // Check if user status is active
        if ($user->status !== 'active') {
            Alert::error('Akun Belum Aktif', 'Silakan verifikasi akun Anda terlebih dahulu');
            return back()->with('error', 'Akun belum aktif');
        }

        // Generate and send OTP for login
        $otp = rand(100000, 999999);
        $verify = Verification::create([
            'user_id' => $user->id,
            'unique_id' => uniqid(),
            'otp' => md5($otp),
            'type' => 'login',
            'send_via' => 'email',
            'status' => 'active',
        ]);
        
        Mail::to($user->email)->send(new OtpEmail($otp));

        // Store user ID in session for OTP verification
        session(['login_user_id' => $user->id]);

        Alert::success('OTP Terkirim', 'Kode OTP telah dikirim ke email Anda');
        return redirect('/verify/' . $verify->unique_id);
    }

    function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|max:50|min:8',
            'confirm_password' => 'required|max:50|min:8|same:password',
            'role' => 'required|in:pembeli,penjual',
        ], [
            'password.min' => 'Password harus minimal 8 karakter',
            'confirm_password.min' => 'Konfirmasi password harus minimal 8 karakter',
            'confirm_password.same' => 'Konfirmasi password tidak cocok',
            'role.required' => 'Silakan pilih role',
            'role.in' => 'Role tidak valid',
        ]);

        if ($validator->fails()) {
            Alert::error('Registrasi Gagal', $validator->errors()->first());
            return back()->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'status' => 'verify',
        ]);
        
        Auth::login($user);

        // Generate and send OTP
        $otp = rand(100000, 999999);
        $verify = Verification::create([
            'user_id' => $user->id,
            'unique_id' => uniqid(),
            'otp' => md5($otp),
            'type' => 'register',
            'send_via' => 'email',
            'status' => 'active',
        ]);
        
        Mail::to($user->email)->send(new OtpEmail($otp));

        return redirect('/verify/' . $verify->unique_id);
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
}
