<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewUserRegistered;
use App\Notifications\UserProfileUpdated;
use App\Notifications\UserRemoved;
use Illuminate\Support\Facades\Notification;

class SuperAdminController extends Controller
{
    public function superAdmin(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'active'   => false,
            'phone'    => $request->phone,
            'address'  => $request->address,
            'role'     => 'superAdmin',
        ]);

        // Assign Spatie role
        $user->assignRole('superAdmin');

        // Notify all admins
        $admins = User::whereIn('role', ['admin', 'superAdmin'])
            ->where('id', '!=', $user->id)
            ->get();

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NewUserRegistered($user));
        }

        return back()->with('success', 'Super Admin created successfully!');
    }

    // VIEW (for modal)
    public function show(User $user)
    {
        abort_if($user->role !== 'superAdmin', 403);
        return response()->json($user);
    }

    // UPDATE
    public function update(Request $request, User $user)
    {
        abort_if($user->role !== 'superAdmin', 403);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'phone'    => 'required|string|max:20',
            'address'  => 'required|string|max:255',
            'active'   => 'required|boolean',
            'password' => 'nullable|min:8',
        ]);

        $user->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'active'  => $request->active,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $admins = User::whereIn('role', ['admin', 'superAdmin'])->get();
        Notification::send($admins, new UserProfileUpdated($user));

        return back()->with('success', 'Super Admin updated successfully!');
    }

    // DELETE
    public function destroy(User $user)
    {
        abort_if($user->role !== 'superAdmin', 403);

        $name = $user->name;
        $user->delete();

        $admins = User::whereIn('role', ['admin', 'superAdmin'])->get();
        Notification::send($admins, new UserRemoved($name));

        return back()->with('success', 'Super Admin deleted successfully!');
    }
}
