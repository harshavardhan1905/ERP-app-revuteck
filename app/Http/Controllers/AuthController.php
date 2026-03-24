<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login page
    public function showLoginForm()
    {
        return view('auth.login'); // Assuming you save the HTML as resources/views/auth/login.blade.php
    }

    // Handle the login request
    // Handle the login request
    // Handle the login request
    public function login(Request $request)
    {
        // 1. Validate the form data
        // Removed the strict 'email' format requirement so you can type either 'admin123' or 'admin@gmail.com'
        $request->validate([
            'email' => ['required'], 
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        // 2. Find the user inside the database
        // We query the 'username' column because your DB screenshot shows 'admin@gmail.com' is stored there.
        $user = \App\Models\User::where('email', $request->email)->first();

        // 3. Manual Password Check (For Plain Text)
        // This checks if the user exists AND if the plain text password matches what they typed
        if ($user && $user->password_hash === $request->password) {
            
            // Log the user in manually
            Auth::login($user, $remember);
            
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            // Redirect to the home page on success
            return redirect()->intended('/')->with('success', 'Welcome back!');
        }

        // 4. If login fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}