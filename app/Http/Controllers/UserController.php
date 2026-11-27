<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesAvatar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use HandlesAvatar;

    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username'  => 'required|string|max:255|unique:users,username',
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|string|min:8|confirmed',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $this->processAvatar($request->file('avatar'), 'avatars/users');
        }

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'username'  => 'required|string|max:255|unique:users,username,' . $user->id,
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'password'  => 'nullable|string|min:8|confirmed',
            'avatar'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        if ($request->hasFile('avatar')) {
            $oldAvatar = $user->avatar;
            $validated['avatar'] = $this->processAvatar($request->file('avatar'), 'avatars/users');
            $this->deleteAvatar($oldAvatar);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request, User $user)
    {
        if ($request->user()->is($user)) {
            return redirect()->route('users.index')->with('error', 'You cannot delete the account you are logged in with.');
        }

        $user->delete();
        $this->deleteAvatar($user->avatar);

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
