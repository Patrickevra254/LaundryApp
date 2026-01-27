<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryItem;

class LaundryItemController extends Controller
{
    /**
     * Store new laundry item
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:laundry_categories,id',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'required|boolean',
            'washing_price' => 'required|numeric|min:0',
            'ironing_price' => 'required|numeric|min:0',
            'wash_and_iron_price' => 'required|numeric|min:0',
        ]);

        LaundryItem::create($request->only([
            'name',
            'category_id',
            'icon',
            'is_active',
            'washing_price',
            'ironing_price',
            'wash_and_iron_price',
        ]));

        return redirect()->back()->with('success', 'Laundry item added successfully');
    }

    /**
     * Fetch item for AJAX edit
     */
    public function show(LaundryItem $laundryItem)
    {
        return response()->json([
            'id' => $laundryItem->id,
            'name' => $laundryItem->name,
            'category_id' => $laundryItem->category_id,
            'icon' => $laundryItem->icon,
            'is_active' => $laundryItem->is_active,
            'washing_price' => $laundryItem->washing_price,
            'ironing_price' => $laundryItem->ironing_price,
            'wash_and_iron_price' => $laundryItem->wash_and_iron_price,
        ]);
    }

    /**
     * Update laundry item
     */
    public function update(Request $request, LaundryItem $laundryItem)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:laundry_categories,id',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'required|boolean',
            'washing_price' => 'required|numeric|min:0',
            'ironing_price' => 'required|numeric|min:0',
            'wash_and_iron_price' => 'required|numeric|min:0',
        ]);

        $laundryItem->update($request->only([
            'name',
            'category_id',
            'icon',
            'is_active',
            'washing_price',
            'ironing_price',
            'wash_and_iron_price',
        ]));

        return redirect()->back()->with('success', 'Laundry item updated successfully');
    }

    /**
     * Delete laundry item
     */
    public function destroy(LaundryItem $laundryItem)
    {
        $laundryItem->delete();

        return redirect()->back()->with('success', 'Laundry item deleted');
    }
}
