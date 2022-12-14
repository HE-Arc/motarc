<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Psy\Readline\Hoa\Console;

class LoginController extends Controller
{
    public function index()
    {
        return Inertia::render('Auth/Login');
    }

    public function register()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->regenerate();
            // redirect to the intended route with inertia

            // if user was in register page, redirect to home page
            if (strpos(url()->previous(), 'register') !== false) {
                return redirect()->route('/')->with('success', 'User logged in successfully.');
            }

            return redirect()->intended()->with('success', 'User logged in successfully.');
            //return redirect()->route('users.index')->with('success', 'User logged in successfully.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        // redirect to the intended route with inertia
        return redirect()->intended()->with('success', 'User logged out successfully.');
        //return redirect()->route('users.index')->with('success', 'User logged out successfully.');
    }
}
