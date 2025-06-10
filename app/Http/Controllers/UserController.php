<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('index', compact('users'));
    }

    public function createNewUser(Request $request)
    {
        $request->validate([
            'name' => 'required|max:55',
            'email' => 'required',
            'password' => 'required|max:20'
        ]);

        $addNew = new User();
        $addNew->name = $request->name;
        $addNew->email = $request->email;
        $addNew->password = bcrypt($request->password); // <--- FIXED

        $addNew->save();

        return back()->with('success', 'User has been added successfully!');
    }

    // Update an existing user
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:55',
            'email' => 'required',
            'password' => 'nullable|max:20'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        return back()->with('success', 'User has been updated successfully!');
    }

    // Delete a user
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User has been deleted successfully!');
    }
}
