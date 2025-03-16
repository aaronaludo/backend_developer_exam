<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function editProfile()
    {
        return view('account.edit-profile');
    }

    public function changePassword()
    {
        return view('account.change-password');
    }

    public function editProfileProcess(Request $request)
    {

        $user_id = $request->user()->id;

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $user_id,
        ]);

        $user = User::find(auth()->guard('web')->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('edit-profile')->with('success', 'Profile updated successfully');
    }
    
    public function changePasswordProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('change-password')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::find(auth()->guard('web')->user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->route('change-password')->with('error', 'Incorrect old password');
        }
        
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('change-password')->with('success', 'Password changed successfully');
    }
}
