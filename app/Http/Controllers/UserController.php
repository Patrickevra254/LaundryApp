<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;

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

        $users = $query->latest()->paginate(1)->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.superAdmin', compact('users'));
        }

        return view('layouts.admin', [
            'content' => view('adminSections2.superAdmin', compact('users'))->render()
        ]);
    }

    public function admin(Request $request)
    {
        $query = User::where('role', 'admin')->with('branch');

        // Admins can only see admins from their own branch
        if (auth()->user()->role === 'admin') {
            $query->where('branch_id', auth()->user()->branch_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhereHas('branch', function ($b) use ($search) {
                        $b->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        $users    = $query->latest()->paginate(5)->withQueryString();
        $branches = Branch::where('is_active', true)->orderBy('name')->get();

        if ($request->header('HX-Request')) {
            return view('adminSections2.admin', compact('users', 'branches'));
        }

        return view('layouts.admin', [
            'content' => view('adminSections2.admin', compact('users', 'branches'))->render()
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

        $users = $query->latest()->paginate(10)->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.customers', compact('users'));
        }

        return view('layouts.admin', [
            'content' => view('adminSections2.customers', compact('users'))->render()
        ]);
    }

    public function staffIndex(Request $request)
    {
        $query = User::where('role', 'staff')->with('branch');

        // Admins and staff can only see users from their own branch
        if (in_array(auth()->user()->role, ['admin', 'staff'])) {
            $query->where('branch_id', auth()->user()->branch_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone', 'LIKE', "%{$search}%")
                    ->orWhereHas('branch', function ($b) use ($search) {
                        $b->where('name', 'LIKE', "%{$search}%");
                    });
            });
        }

        $users    = $query->latest()->paginate(5)->withQueryString();
        $branches = Branch::where('is_active', true)->orderBy('name')->get();

        if ($request->header('HX-Request')) {
            return view('adminSections2.staff', compact('users', 'branches'));
        }

        return view('layouts.admin', [
            'content' => view('adminSections2.staff', compact('users', 'branches'))->render()
        ]);
    }
}
