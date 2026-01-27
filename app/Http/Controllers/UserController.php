<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function superAdmin(Request $request)
    {
        $query = User::where('role', 'superadmin');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->latest()
            ->paginate(1)
            ->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.superAdmin', compact('users'));
        }

        return view('layouts.admin', [
            'content' => view('adminSections2.superAdmin', compact('users'))->render()
        ]);
    }

    // public function admin(Request $request)
    // {
    //     $users = User::where('role', 'admin')->latest()
    //         ->paginate(3);

    //     if ($request->header('HX-Request')) {
    //         return view('adminSections2.admin', compact('users'));
    //     }

    //     return view('layouts.admin', [
    //         'content' => view('adminSections2.admin', compact('users'))->render()
    //     ]);
    // }

    public function admin(Request $request)
    {
        $query = User::where('role', 'admin');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->latest()
            ->paginate(1)
            ->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.admin', compact('users'));
        }

        return view('layouts.admin', [
            'content' => view('adminSections2.admin', compact('users'))->render()
        ]);
    }


    public function customerIndex(Request $request)
    {
        $query = User::where('role', 'customer');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->latest()
            ->paginate(1)
            ->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.customers', compact('users'));
        }

        return view('layouts.admin', [
            'content' => view('adminSections2.customers', compact('users'))->render()
        ]);
    }

    public function staffIndex(Request $request)
    {
        $query = User::where('role', 'staff');

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%");
            });
        }

        $users = $query->latest()
            ->paginate(2)
            ->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.staff', compact('users'));
        }

        return view('layouts.admin', [
            'content' => view('adminSections2.staff', compact('users'))->render()
        ]);
    }
}
