<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                return redirect()->route('dashboard');
            }
            return $next($request);
        })->only(['login', 'register']);
    }

    public function login()
    {
        return view('authentication.login');
    }

    public function register()
    {
        return view('authentication.register');
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $user = Auth::guard('web')->user();
            
            return redirect()->intended('/dashboard');
        }

        return redirect()->route('login')->with('error', 'Invalid credentials');
    }

    public function registerProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => ['required', 'confirmed'],
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        Auth::guard('web')->login($user);

        return redirect()->route('dashboard');
    }

    public function logout()
    {
        $user = Auth::user();
    
        if ($user) {
            $user->setRememberToken(null);
            $user->save();
        }
    
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    
        return redirect()->route('login')->with('message', 'Logged out successfully.');
    }
}
