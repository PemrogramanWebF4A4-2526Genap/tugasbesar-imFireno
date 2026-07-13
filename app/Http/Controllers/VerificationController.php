<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Verification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpEmail;

class VerificationController extends Controller
{
    public function index()
    {
        return view('verification.index');
    }

    public function show($unique_id)
    {
        // Check if this is a login OTP verification
        $loginUserId = session('login_user_id');
        
        if ($loginUserId) {
            $verify = Verification::whereUserId($loginUserId)->whereUniqueId($unique_id)->whereStatus('active')->count();
            if (!$verify)
                abort(404);
            return view('verification.show', compact('unique_id', 'loginUserId'));
        }
        
        // Register OTP verification (existing logic)
        $verify = Verification::whereUserId(Auth::user()->id)->whereUniqueId($unique_id)->whereStatus('active')->count();
        if (!$verify)
            abort(404);
        return view('verification.show', compact('unique_id'));
    }

    public function update(Request $request, $unique_id)
    {
        $loginUserId = session('login_user_id');
        
        // Handle login OTP verification
        if ($loginUserId) {
            $verify = Verification::whereUserId($loginUserId)->whereUniqueId($unique_id)->whereStatus('active')->first();
            if (!$verify)
                abort(404);
            
            if (md5($request->otp) != $verify->otp) {
                $verify->update(['status' => 'invalid']);
                session()->forget('login_user_id');
                return redirect('/login')->with('error', 'OTP salah');
            }
            
            $verify->update(['status' => 'valid']);
            $user = User::find($verify->user_id);
            
            // Login the user
            Auth::login($user);
            session()->forget('login_user_id');
            
            // Redirect based on role
            if ($user->role === 'penjual') {
                return redirect('/seller/dashboard');
            } elseif ($user->role === 'pembeli') {
                return redirect('/home');
            } else {
                return redirect('/dashboard');
            }
        }
        
        // Handle register OTP verification (existing logic)
        $verify = Verification::whereUserId(Auth::user()->id)->whereUniqueId($unique_id)->whereStatus('active')->first();
        if (!$verify)
            abort(404);
        if (md5($request->otp) != $verify->otp) {
            $verify->update(['status' => 'invalid']);
            return redirect('/verify');
        }
        $verify->update(['status' => 'valid']);
        $user = User::find($verify->user_id);
        $user->update(['status' => 'active']);

        // Redirect based on role
        if ($user->role === 'penjual') {
            return redirect('/seller/dashboard');
        } else {
            return redirect('/home');
        }
    }
    public function store(Request $request) {
        $user = null;
        if($request->type == 'register') {
            $user = User::find($request->user()->id);
        } else {
            // logic for login
            $user = User::find($request->user()->id);
        }
        if(!$user) return back()->with('failed', 'User not found');
        $otp = rand(100000, 999999);
        $verify = Verification::create([
            'user_id' => $user->id,
            'unique_id' => uniqid(),
            'otp' => md5($otp),
            'type' => $request->type,
            'send_via' => 'email',
            'status' => 'active',
        ]);
        Mail::to($user->email)->send(new OtpEmail($otp));
        
        return redirect('/verify/' . $verify->unique_id);
    }
}
