<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewUserRegistered;
use Illuminate\Support\Facades\Notification;

class AuthController extends Controller
{
    public function index()
    {
        return view('layouts.login3');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'phone'    => 'required|string|max:20|unique:users,phone',
            'address'  => 'required|string|max:255',
        ], [
            'email.unique' => 'This email already exists.',
            'phone.unique' => 'This phone number already exists.',
        ]);

        $user = DB::transaction(function () use ($request) {

            // Lock to prevent race condition — two people registering at same time
            $isFirstUser = User::lockForUpdate()->count() === 0;

            $role = $isFirstUser ? 'superAdmin' : 'customer';

            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password),
                'active'   => true,
                'phone'    => $request->phone,
                'address'  => $request->address,
                'role'     => $role, // keep column in sync for direct checks
            ]);

            // Assign Spatie role
            $user->assignRole($role);

            return $user;
        });

        // Notify admins/superAdmins — skip if this IS the first user (no one to notify yet)
        $admins = User::whereIn('role', ['admin', 'superAdmin'])
            ->where('id', '!=', $user->id)
            ->get();

        if ($admins->isNotEmpty()) {
            Notification::send($admins, new NewUserRegistered($user));
        }

        Auth::login($user);

        return redirect()->route('admin-dashboard')->with('success', 'Account created successfully!');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('rememberMe');

        if (!Auth::attempt($credentials, $remember)) {
            return back()->with('error', 'Invalid login details.');
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $user->active = true;
        $user->save();

        return redirect()->route('admin-dashboard')->with('success', 'Login Successful!');
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->active = false;
            $user->save();
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}



// class AuthController extends Controller
// {
//     public function index()
//     {
//         return view('layouts.login3');
//     }

//     public function register(Request $request)
//     {
//         $request->validate([
//             'name'     => 'required|string|max:255',
//             'email'    => 'required|email|unique:users',
//             'password' => 'required|confirmed|min:8',
//             'phone'    => 'required|string|max:20',
//             'address'  => 'required|string|max:255',
//         ]);

//         $user = DB::transaction(function () use ($request) {
//             $isFirstUser = User::lockForUpdate()->count() === 0;
//             $role        = $isFirstUser ? 'superAdmin' : 'customer';

//             $user = User::create([
//                 'name'     => $request->name,
//                 'email'    => $request->email,
//                 'password' => Hash::make($request->password),
//                 'active'   => true,
//                 'phone'    => $request->phone,
//                 'address'  => $request->address,
//                 'role'     => $role,
//             ]);

//             $user->assignRole($role);
//             return $user;
//         });

//         $admins = User::whereIn('role', ['admin', 'superAdmin'])
//             ->where('id', '!=', $user->id)
//             ->get();

//         if ($admins->isNotEmpty()) {
//             Notification::send($admins, new NewUserRegistered($user));
//         }

//         Auth::login($user);

//         return redirect()->route($this->redirectRoute($user))
//             ->with('success', 'Account created successfully!');
//     }

//     public function login(Request $request)
//     {
//         $credentials = $request->validate([
//             'email'    => 'required|email',
//             'password' => 'required',
//         ]);

//         $remember = $request->has('rememberMe');

//         if (!Auth::attempt($credentials, $remember)) {
//             return back()->with('error', 'Invalid login details.');
//         }

//         $request->session()->regenerate();

//         $user = Auth::user();
//         $user->active = true;
//         $user->save();

//         return redirect()->route($this->redirectRoute($user))
//             ->with('success', 'Login Successful!');
//     }

//     public function logout(Request $request)
//     {
//         if (Auth::check()) {
//             $user = Auth::user();
//             $user->active = false;
//             $user->save();
//         }

//         Auth::logout();
//         $request->session()->invalidate();
//         $request->session()->regenerateToken();

//         return redirect()->route('login');
//     }

//     // ── Route based on role ───────────────────────────────────
//     private function redirectRoute(User $user): string
//     {
//         return match($user->role) {
//             'customer' => 'customerDashboard',
//             default    => 'dashboard',
//         };
//     }
// }
