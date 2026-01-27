<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'active' => true, // ✅ Mark new user as active
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // notify all admins
        $roles = User::whereIn('role', ['admin', 'superAdmin'])->get();

        Notification::send($roles, new NewUserRegistered($user));

        Auth::login($user);


        // Redirect to the login after successful login
        return redirect()->route('admin-dashboard')->with('success', 'Account Created Successfuly!'); // redirect to dashboard
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('rememberMe');

        if (!Auth::attempt($credentials, $remember)) {
            return back()->with('error', 'Invalid login details.');
        }

        $request->session()->regenerate();

        // ✅ Set user active on login
        $user = Auth::user();
        $user->active = true;
        $user->save();

        // Redirect to the login after successful registration
        return redirect()->route('admin-dashboard')->with('success', 'Login Successful!'); // redirect to dashboard
    }

    public function logout(Request $request)
    {
        // ✅ Set user inactive on logout
        if (Auth::check()) {
            $user = Auth::user();
            $user->active = false;
            $user->save();
        }

        // logging out
        Auth::logout();  // Log the user out

        // Optionally, invalidate the session or regenerate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');  // Redirect to login page
    }
}
