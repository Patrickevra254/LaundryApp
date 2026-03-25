<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'address'    => 'required|string|max:255',
            'phone'      => 'nullable|string|max:25',
            'email'      => 'nullable|email|max:255',
            'manager_id' => 'nullable|exists:users,id',
        ]);

        Branch::create([
            'name'       => $request->name,
            'address'    => $request->address,
            'phone'      => $request->phone,
            'email'      => $request->email,
            'manager_id' => $request->manager_id ?: null,
            'is_active'  => true,
        ]);

        return redirect()->back()->with('success', 'Branch created successfully.');
    }

    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'address'    => 'required|string|max:255',
            'phone'      => 'nullable|string|max:25',
            'email'      => 'nullable|email|max:255',
            'manager_id' => 'nullable|exists:users,id',
            'is_active'  => 'boolean',
        ]);

        $branch->update([
            'name'       => $request->name,
            'address'    => $request->address,
            'phone'      => $request->phone,
            'email'      => $request->email,
            'manager_id' => $request->manager_id ?: null,
            'is_active'  => $request->boolean('is_active'),
        ]);

        return redirect()->back()->with('success', 'Branch updated successfully.');
    }

    public function destroy(Branch $branch)
    {
        $branch->delete();
        return redirect()->back()->with('success', 'Branch "' . $branch->name . '" deleted successfully.');
    }
}
