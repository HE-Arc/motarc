<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        return Inertia::render('Profile/Show', [
            'user' => Auth::user(),
        ]);
    }

    public function edit()
    {
        return Inertia::render('Profile/Edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request)
    {
        // Do not update the password if it is empty
        if (!$request->password) {
            $request->merge(['password' => Auth::user()->password]);
            $request->merge(['password_confirmation' => Auth::user()->password]);
        }

        // validate the request
        $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|max:50',
            'npa' => 'required|integer|digits:4',
            'password' => 'sometimes|confirmed|min:8|max:255',
        ]);

        if ($request->password) {
            $request->merge(['password' => Hash::make($request->password)]);
        }

        // update the user with optional password and return to profile
        $userId = Auth::user()->id;
        User::findOrFail($userId)->update($request->all());

        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;
        Auth::user()->npa = $request->npa;

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');

        /* return Inertia::render('Profile/Show', [
            'user' => Auth::user(),
        ]); */
    }
}
