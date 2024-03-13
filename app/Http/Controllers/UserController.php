<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function loginUser(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $credentials = $request->only('email');
        $credentials['password'] = $request->input('password'); // Fetch plain text password

        // Hash the password before attempting authentication
        $hashedPassword = Hash::make($credentials['password']);
        $userPassword = User::where('email', $credentials['email'])->value('password');

        if (Hash::check($credentials['password'], $userPassword)) {
            if (Auth::attempt($credentials, $remember = true)) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));

    }

    public function logoutUser(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
