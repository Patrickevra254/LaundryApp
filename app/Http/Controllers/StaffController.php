<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewUserRegistered;
use App\Notifications\UserProfileUpdated;
use App\Notifications\UserRemoved;
use Illuminate\Support\Facades\Notification;

// class StaffController extends Controller
// {
//     public function storeStaff(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users',
//             'password' => 'required|confirmed|min:8',
//             'phone' => 'required|string|max:20',
//             'address' => 'required|string|max:255',

//         ]);

//         $user = User::create([
//             'name' => $request->name,
//             'email' => $request->email,
//             'password' => Hash::make($request->password),
//             'active' => false, // ✅ Mark new user as non-active
//             'phone' => $request->phone,
//             'address' => $request->address,
//             'role' => 'staff',
//         ]);

//          // Assign Spatie role
//         $user->assignRole('staff');

//         // notify all admins
//         $roles = User::whereIn('role', ['admin', 'superAdmin'])->get();

//         Notification::send($roles, new NewUserRegistered($user));

//         return back()->with('success', 'Staff created successfully!');
//     }

//     // VIEW STAFF
//     public function show(User $user)
//     {
//         abort_if($user->role !== 'staff', 403);

//         return response()->json($user);
//     }

//     // UPDATE STAFF
//     public function update(Request $request, User $user)
//     {
//         abort_if($user->role !== 'staff', 403);

//         $request->validate([
//             'name' => 'required|string|max:255',
//             'email' => 'required|email|unique:users,email,' . $user->id,
//             'phone' => 'required|string|max:20',
//             'address' => 'required|string|max:255',
//             'active' => 'required|boolean',
//             'password' => 'nullable|min:8',
//         ]);

//         $user->update([
//             'name' => $request->name,
//             'email' => $request->email,
//             'phone' => $request->phone,
//             'address' => $request->address,
//             'active' => $request->active,
//         ]);

//         if ($request->filled('password')) {
//             $user->update([
//                 'password' => Hash::make($request->password),
//             ]);
//         }

//         $roles = User::whereIn('role', ['admin', 'superAdmin'])->get();
//         Notification::send($roles, new UserProfileUpdated($user));

//         return back()->with('success', 'Staff updated successfully!');
//     }

//     // DELETE STAFF
//     public function destroy(User $user)
//     {
//         abort_if($user->role !== 'staff', 403);

//         $user->delete();

//         $roles = User::whereIn('role', ['admin', 'superAdmin'])->get();
//         Notification::send($roles, new UserRemoved($user->name));

//         return back()->with('success', 'Staff deleted successfully!');
//     }
// }


class StaffController extends Controller
{
    public function storeStaff(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|confirmed|min:8',
            'phone'     => 'required|string|max:20|unique:users',
            'address'   => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'active'    => false,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'role'      => 'staff',
            'branch_id' => $request->branch_id,
        ]);

        $user->assignRole('staff');

        $roles = User::whereIn('role', ['admin', 'superAdmin'])->get();
        Notification::send($roles, new NewUserRegistered($user));

        return back()->with('success', 'Staff created successfully!');
    }

    public function show(User $user)
    {
        abort_if($user->role !== 'staff', 403);
        return response()->json($user->load('branch'));
    }

    public function update(Request $request, User $user)
    {
        abort_if($user->role !== 'staff', 403);

        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'phone'     => 'required|string|max:20|unique:users,phone,' . $user->id,
            'address'   => 'required|string|max:255',
            'active'    => 'required|boolean',
            'password'  => 'nullable|min:8',
            'branch_id' => 'required|exists:branches,id',
        ]);

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
            'active'    => $request->active,
            'branch_id' => $request->branch_id,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $roles = User::whereIn('role', ['admin', 'superAdmin'])->get();
        Notification::send($roles, new UserProfileUpdated($user));

        return back()->with('success', 'Staff updated successfully!');
    }

    public function destroy(User $user)
    {
        abort_if($user->role !== 'staff', 403);

        // delete related orders first
        // $user->laundryOrders()->delete();

        $user->delete();

        $roles = User::whereIn('role', ['admin', 'superAdmin'])->get();
        Notification::send($roles, new UserRemoved($user->name));

        return back()->with('success', 'Staff deleted successfully!');
    }
}
