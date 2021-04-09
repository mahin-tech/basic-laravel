<?php

namespace App\Http\Controllers;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
    public function ChangePassword() {
        return view('admin.body.change_password');
    }

    public function UpdatePassword(Request $request) {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword, $hashedPassword)) {
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();

            return Redirect()->route('login')->with('success', 'Password Change Was Successfully');
        } else {
            return Redirect()->back()->with('error', 'Current Password is Invalid');
        }
    }

    public function ProfileUpdate() {
        if(Auth::user()) {
            $user = User::find(Auth::user()->id);
            if($user) {
                return view('admin.body.update_profile', compact('user'));
            }
        }
    }

    public function UpdateUserProfile(Request $request) {
        $user = User::find(Auth::user()->id);
        if($user) {
            $user->name = $request['name'];
            $user->email = $request['email'];

            $user->save();
            return Redirect()->back()->with('success', 'User Profile is Update Successfully');
        } else {
            return Redirect()->back();
        }
    }
}
