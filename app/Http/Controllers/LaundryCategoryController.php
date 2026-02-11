<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryCategory;

class LaundryCategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255|unique:laundry_categories,type',
        ]);

        LaundryCategory::create([
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Category added successfully');
    }

    public function destroy(LaundryCategory $category)
    {
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
