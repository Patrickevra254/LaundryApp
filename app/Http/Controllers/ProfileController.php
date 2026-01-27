<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        // If HTMX request → return ONLY the section HTML
        if ($request->header('HX-Request')) {
            return view('adminSections2.profile', compact('user'));
        }

        // Full page load → inject the partial into your layout
        return view('layouts.admin', [
            'content' => view('adminSections2.profile', compact('user'))->render()
        ]);
    }



    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:25',
            'address' => 'nullable|string|max:255',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6'
        ]);

        // Password update logic
        if ($request->filled('new_password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors([
                    'current_password' => 'Current password is incorrect.'
                ]);
            }
            $user->password = Hash::make($request->new_password);
        }

        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->address = $validated['address'];
        $user->phone = $validated['phone'] ?? null;
        $user->save();

        // 🔥 If the request is HTMX → return ONLY the profile page HTML
        if ($request->header('HX-Request')) {
            return view('adminSections2.profile', [
                'user' => $user,
                'success' => 'Profile updated successfully!'
            ]);
        }

        // Normal redirect (fallback)
        // return redirect()->route('profile')->with('success', 'Profile updated!');
        return redirect()->back()->with('success', 'Profile updated!');
    }
}
