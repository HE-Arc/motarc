<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'npa' => 'required|integer',
        ]);

        \App\Models\User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show($userId)
    {
        $user = \App\Models\User::findOrFail($userId);
        return view('users.show', ['user' => $user]);
    }

    public function edit($userId)
    {
        $user = \App\Models\User::where('id', $userId)->firstOrFail();
        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $userId)
    {
        \App\Models\User::findOrFail($userId)->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($userId)
    {
        $user = \App\Models\User::find($userId);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
