<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryItem;

// class LaundryItemController extends Controller
// {
//     /**
//      * Store new laundry item
//      */
//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'category_id' => 'required|exists:laundry_categories,id',
//             'icon' => 'nullable|string|max:50',
//             'is_active' => 'required|boolean',
//             'washing_price' => 'required|numeric|min:0',
//             'ironing_price' => 'required|numeric|min:0',
//             'wash_and_iron_price' => 'required|numeric|min:0',
//         ]);

//         LaundryItem::create($request->only([
//             'name',
//             'category_id',
//             'icon',
//             'is_active',
//             'washing_price',
//             'ironing_price',
//             'wash_and_iron_price',
//         ]));

//         return redirect()->back()->with('success', 'Laundry item added successfully');
//     }

//     /**
//      * Fetch item for AJAX edit
//      */
//     public function show(LaundryItem $laundryItem)
//     {
//         return response()->json([
//             'id' => $laundryItem->id,
//             'name' => $laundryItem->name,
//             'category_id' => $laundryItem->category_id,
//             'icon' => $laundryItem->icon,
//             'is_active' => $laundryItem->is_active,
//             'washing_price' => $laundryItem->washing_price,
//             'ironing_price' => $laundryItem->ironing_price,
//             'wash_and_iron_price' => $laundryItem->wash_and_iron_price,
//         ]);
//     }

//     /**
//      * Update laundry item
//      */
//     public function update(Request $request, LaundryItem $laundryItem)
//     {
//         $request->validate([
//             'name' => 'required|string|max:255',
//             'category_id' => 'required|exists:laundry_categories,id',
//             'icon' => 'nullable|string|max:50',
//             'is_active' => 'required|boolean',
//             'washing_price' => 'required|numeric|min:0',
//             'ironing_price' => 'required|numeric|min:0',
//             'wash_and_iron_price' => 'required|numeric|min:0',
//         ]);

//         $laundryItem->update($request->only([
//             'name',
//             'category_id',
//             'icon',
//             'is_active',
//             'washing_price',
//             'ironing_price',
//             'wash_and_iron_price',
//         ]));

//         return redirect()->back()->with('success', 'Laundry item updated successfully');
//     }

//     /**
//      * Delete laundry item
//      */
//     public function destroy(LaundryItem $laundryItem)
//     {
//         $laundryItem->delete();

//         return redirect()->back()->with('success', 'Laundry item deleted');
//     }
// }


class LaundryItemController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'category_id'        => 'required|exists:laundry_categories,id',
            'washing_price'      => 'required|numeric|min:0',
            'ironing_price'      => 'required|numeric|min:0',
            'wash_and_iron_price' => 'required|numeric|min:0',
            'due_days'           => 'required|integer|min:1',
            'icon'               => 'required|string',
            'is_active'          => 'boolean',
        ]);

        LaundryItem::create([
            'name'               => $request->name,
            'category_id'        => $request->category_id,
            'washing_price'      => $request->washing_price,
            'ironing_price'      => $request->ironing_price,
            'wash_and_iron_price' => $request->wash_and_iron_price,
            'due_days'           => $request->due_days,
            'icon'               => $request->icon,
            'is_active'          => $request->is_active ?? 1,
        ]);

        return back()->with('success', 'Item created successfully.');
    }

    public function show(LaundryItem $laundryItem)
    {
        return response()->json($laundryItem);
    }

    public function update(Request $request, LaundryItem $laundryItem)
    {
        $request->validate([
            'name'               => 'required|string|max:255',
            'category_id'        => 'required|exists:laundry_categories,id',
            'washing_price'      => 'required|numeric|min:0',
            'ironing_price'      => 'required|numeric|min:0',
            'wash_and_iron_price' => 'required|numeric|min:0',
            'due_days'           => 'required|integer|min:1',
            'icon'               => 'required|string',
            'is_active'          => 'boolean',
        ]);

        $laundryItem->update([
            'name'               => $request->name,
            'category_id'        => $request->category_id,
            'washing_price'      => $request->washing_price,
            'ironing_price'      => $request->ironing_price,
            'wash_and_iron_price' => $request->wash_and_iron_price,
            'due_days'           => $request->due_days,
            'icon'               => $request->icon,
            'is_active'          => $request->is_active ?? 1,
        ]);

        return back()->with('success', 'Item updated successfully.');
    }

    public function destroy(LaundryItem $laundryItem)
    {
        $laundryItem->delete();
        return back()->with('success', 'Item deleted successfully.');
    }
}
