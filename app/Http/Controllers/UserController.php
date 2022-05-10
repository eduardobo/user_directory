<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('searcher');

        $users = User::when($search, function($q) use ($search) {
            $q->where('name', 'like', "%$search%");
        })
        ->get();

        return view('user.index', compact('users'));
    }

    public function create() 
    {
        $user = new User();

        return view('user.create', compact('user'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'age' => 'numeric',
            'active' => 'boolean'
        ]);

        User::create($attributes);

        return response()->json(['message' => 'User created']);
    }

    public function edit(User $user)
    {
        return view('user.create', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'age' => 'numeric',
            'active' => 'boolean'
        ]);

        $user->update($attributes);

        return response()->json(['message' => 'User updated']);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
}
