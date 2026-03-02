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
    public function searchCustomers(Request $request)
    {
        $query = $request->get('q');

        $customers = User::where('role', 'customer')
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                    ->orWhere('phone', 'like', "%{$query}%");
            })
            ->limit(10)
            ->get();

        return view('partials.customerOptions', compact('customers'));
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|string|max:20',
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
            'phone' => 'required|string|max:20',
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
