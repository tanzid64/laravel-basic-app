<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function admin_login(Request $request){
        // ** Get Credentials from Request **
        $credentials = $request->only('email', 'password');

        // ** Check if Credentials are Valid **
        if(Auth::attempt($credentials)){
            $user = Auth::user();
            // ** Generate Verification Code **
            $verificationCode = random_int(100000, 999999);
            // ** Store Verification Code in Session **
            session(['verification_code' => $verificationCode, 'user_id' => $user->id]);
            // ** Send Verification Code to User Email **
            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
            // ** Logout User **
            Auth::logout();
            // ** Redirect to Verification Page **
            return redirect(route('admin.verify'))->with('message', 'Verification Code Sent to Your Email');
        };
        // ** Redirect to Login Page **
        return redirect()->back()->withErrors(['email' => 'Invalid Credentials']);
    }

    public function admin_verify(Request $request){
        return view('auth.verify');
    }

    public function admin_verification_verify(Request $request){
        $request->validate([
            'verification_code' => 'required|numeric|digits:6',
        ]);
        
        
    }

    public function admin_logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
