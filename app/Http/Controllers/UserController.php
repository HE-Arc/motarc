<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use IntlChar;

class UserController extends Controller
{
    /* Not used */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /* Not used */
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'email' => 'required|email|max:50',
            'password' => 'required|confirmed|min:8|max:255',
            'npa' => 'required|integer|digits:4',
        ]);

        // hash password before storing it in the database
        $request->merge(['password' => Hash::make($request->password)]);

        User::create($request->all());

        return redirect()->route('/login')->with('success', 'User created successfully.');
        //return Inertia::render('Auth/Login');
        //return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /* Not used */
    public function show($userId)
    {
        $user = User::findOrFail($userId);

        return Inertia::render('Users/MyAccount', [
            'user' => $user,
        ]);

        //return view('users.show', ['user' => $user]);
    }

    /* Not used */
    public function edit($userId)
    {
        $user = User::where('id', $userId)->firstOrFail();
        return view('users.edit', ['user' => $user]);
    }

    /* Not used */
    public function update(Request $request, $userId)
    {
        // hash password before storing it in the database
        $request->merge(['password' => Hash::make($request->password)]);

        User::findOrFail($userId)->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($userId)
    {
        $user = User::find($userId);
        $user->delete();

        return redirect()->route('/')->with('success', 'User deleted successfully');
    }

    // login function
}
