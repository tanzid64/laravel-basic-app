<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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
            'verification_code' => 'required|numeric',
        ]);

        $verificationCode = $request->input('verification_code');
        $code = session('verification_code');

        if($verificationCode == $code){
            Auth::loginUsingId(session('user_id'));
            session()->forget('verification_code', 'user_id');
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->back()->withErrors(['verification_code' => 'Invalid Verification Code']);
    }

    public function admin_logout(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function admin_profile(){
        $user_id = Auth::user()->id;
        $user_data = User::find($user_id);
        return view('admin.profile', compact('user_data'));
    }

    public function admin_profile_update(Request $request){
        $user_id = Auth::user()->id;
        $user_data = User::find($user_id);
        // ** Update User Data **
        $user_data->name = $request->name;
        $user_data->email = $request->email;
        $user_data->phone = $request->phone;
        $user_data->address = $request->address;
        // ** Update Profile Photo **
        $old_photo_path = $user_data->photo;
        if($request->hasFile('photo')){
            $file = $request->file('photo');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $filename);
            $user_data->photo = $filename;
            // ** Delete Old Photo **
            if($old_photo_path && $old_photo_path != $filename){
                unlink(public_path('upload/user_images/'.$old_photo_path));
            }
        }
        $user_data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function admin_password_update(Request $request)
    {
        $user = Auth::user();

        // Step 1: Validate basic rules
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        // Step 2: Add custom old password check
        $validator->after(function ($validator) use ($request, $user) {
            if (!Hash::check($request->old_password, $user->password)) {
                $validator->errors()->add('old_password', 'The old password is incorrect.');
            }
        });

        // Step 3: Return with errors if validation fails
        if ($validator->fails()) {
            $notification = array(
                'message' => 'Validation Error',
                'alert-type' => 'error'
            );
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with($notification);
        }

        // Step 4: Update the password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        Auth::logout();
        // Step 5: Optional success message
        return redirect()->route('admin.login')->with([
            'message' => 'Password updated successfully.',
            'alert-type' => 'success',
        ]);
    }
}
