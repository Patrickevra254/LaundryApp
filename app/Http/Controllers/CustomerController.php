<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewUserRegistered;
use App\Notifications\UserProfileUpdated;
use App\Notifications\UserRemoved;
use Illuminate\Support\Facades\Notification;

class CustomerController extends Controller
{
    // real time population for customer by name or phone
    public function searchCustomers(Request $request)
    {
        $q = trim($request->q);

        if (!$q) {
            return response()->json([]);
        }

        // Normalize phone input — handle +234 or 234 prefix
        $normalized = preg_replace('/\D/', '', $q);
        if (str_starts_with($normalized, '234')) {
            $normalized = '0' . substr($normalized, 3);
        }

        $customers = User::where('role', 'customer')
            ->where(function ($query) use ($q, $normalized) {

                if (!empty($normalized)) {
                    $query->where('phone', 'like', '%' . $normalized . '%');
                } else {
                    $query->where('name', 'like', '%' . $q . '%');
                }
            })
            ->limit(8)
            ->get(['id', 'name', 'phone', 'email']);

        return response()->json($customers);
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|string|max:20|unique:users',
            'address' => 'required|string|max:255',

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' => false, // ✅ Mark new user as non-active
            'phone' => $request->phone,
            'address' => $request->address,
            'role' => 'customer',
        ]);

        // Assign Spatie role
        $user->assignRole('customer');

        // notify all admins
        $roles = User::whereIn('role', ['admin', 'superAdmin'])->get();

        Notification::send($roles, new NewUserRegistered($user));

        return back()->with('success', 'Customer created successfully!');
    }


    // VIEW CUSTOMER
    public function show(User $user)
    {
        abort_if($user->role !== 'customer', 403);

        return response()->json($user);
    }

    // UPDATE CUSTOMER
    public function update(Request $request, User $user)
    {
        abort_if($user->role !== 'customer', 403);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20|unique:users,phone,' . $user->id,
            'address' => 'required|string|max:255',
            'active' => 'required|boolean',
            'password' => 'nullable|min:8',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'active' => $request->active,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $roles = User::whereIn('role', ['admin', 'superAdmin'])->get();
        Notification::send($roles, new UserProfileUpdated($user));

        return back()->with('success', 'Customer updated successfully!');
    }

    // DELETE CUSTOMER
    public function destroy(User $user)
    {
        abort_if($user->role !== 'customer', 403);

        $user->delete();

        $roles = User::whereIn('role', ['admin', 'superAdmin'])->get();
        Notification::send($roles, new UserRemoved($user->name));

        return back()->with('success', 'Customer deleted successfully!');
    }
}
