<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryCategory;
use App\Models\LaundryItem;
use App\Models\LaundryOrder;
use App\Models\User;
use App\Models\Payment;
use Carbon\Carbon;


class AdminController extends Controller
{

    // this block is what calls the partial pages into the admin main-area using HX-Request

    public function dashboard(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections.dashboard'); // partial
        }

        return view('layouts.admin', [
            'title' => 'Dashboard',
            'content' => view('adminSections.dashboard')
        ]);
    }


    public function superAdmin(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections2.superAdmin'); // partial only
        }

        return view('layouts.admin', [
            'title' => 'Super-Admin',
            'content' => view('adminSections2.superAdmin')
        ]);
    }



    public function admin(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections2.admin'); // partial only
        }

        return view('layouts.admin', [
            'title' => 'Admin',
            'content' => view('adminSections2.admin')
        ]);
    }

    public function customers(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections2.customers'); // partial only
        }

        return view('layouts.admin', [
            'title' => 'Customers',
            'content' => view('adminSections2.customers')
        ]);
    }

    public function bookLaundry(Request $request)
    {
        $items = LaundryItem::with('category')->orderBy('name')->get();
        $customers = User::where('role', 'customer')
            ->orderBy('name')
            ->get();
        if ($request->header('HX-Request')) {
            return view('adminSections2.bookLaundry', compact('customers', 'items'));
        }

        return view('layouts.admin', [
            'title' => 'bookLaundry',
            'content' => view('adminSections2.bookLaundry', compact('customers', 'items'))
        ]);
    }

    // public function history(Request $request)
    // {
    //     $orders = LaundryOrder::with(['customer', 'items'])
    //         ->whereIn('status', ['completed', 'delivered'])
    //         ->latest()
    //         ->paginate(5);
    //     if ($request->header('HX-Request')) {
    //         return view('adminSections2.history', compact('orders'));
    //     }

    //     return view('layouts.admin', [
    //         'title' => 'History',
    //         'content' => view('adminSections2.history', compact('orders'))
    //     ]);
    // }

    public function history(Request $request)
    {
        $query = LaundryOrder::with(['customer', 'items'])
            ->whereIn('status', ['completed', 'delivered']);

        // Restrict for customers
        if (auth()->user()->role === 'customer') {
            $query->where('customer_id', auth()->id());
        }


        //  Text search
        if ($request->filled('q')) {
            $search = strtolower($request->q);

            $query->where(function ($q) use ($search) {
                $q->whereHas('customer', function ($c) use ($search) {
                    $c->where('name', 'LIKE', "%{$search}%");
                })
                    ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"]);
            });
        }

        // Month filter (YYYY-MM)
        if ($request->filled('month')) {
            [$year, $month] = explode('-', $request->month);

            $query->whereYear('created_at', $year)
                ->whereMonth('created_at', $month);
        }

        $orders = $query->latest()
            ->paginate(5)
            ->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.history', compact('orders'));
        }

        return view('layouts.admin', [
            'title' => 'History',
            'content' => view('adminSections2.history', compact('orders')),
        ]);
    }


    public function notifications(Request $request)
    {

        $notifications = auth()->user()
            ->notifications()
            ->latest()
            ->paginate(10);

        if ($request->header('HX-Request')) {
            return view('adminSections2.notifications', compact('notifications'));
        }

        return view('layouts.admin', [
            'title' => 'Notifications',
            'content' => view('adminSections2.notifications', compact('notifications'))
        ]);
    }

    public function profile(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections.profile');
        }

        return view('layouts.admin', [
            'title' => 'Profile',
            'content' => view('adminSections.profile')
        ]);
    }

    public function preferences(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections2.preferences');
        }

        return view('layouts.admin', [
            'title' => 'Preferences',
            'content' => view('adminSections2.preferences')
        ]);
    }

    // public function orderTrack(Request $request)
    // {
    //     $orders = LaundryOrder::with(['customer', 'items'])->latest()->paginate(8); // eager load customer & items
    //     if ($request->header('HX-Request')) {
    //         return view('adminSections2.orderTrack', compact('orders'));
    //     }

    //     return view('layouts.admin', [
    //         'title' => 'OrderTrack',
    //         'content' => view('adminSections2.orderTrack', compact('orders'))
    //     ]);
    // }

    public function orderTrack(Request $request)
    {
        $query = LaundryOrder::with(['customer', 'items']);

        // Restrict for customers
        if (auth()->user()->role === 'customer') {
            $query->where('customer_id', auth()->id());
        }


        //  Text search
        if ($request->filled('q')) {
            $search = strtolower($request->q);

            $query->where(function ($q) use ($search) {
                $q->whereHas('customer', function ($c) use ($search) {
                    $c->where('name', 'LIKE', "%{$search}%");
                })
                    ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"]);
            });
        }


        $orders = $query->latest()
            ->paginate(5)
            ->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.orderTrack', compact('orders'));
        }

        return view('layouts.admin', [
            'title' => 'History',
            'content' => view('adminSections2.orderTrack', compact('orders')),
        ]);
    }


    public function staff(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections2.staff');
        }

        return view('layouts.admin', [
            'title' => 'Staff',
            'content' => view('adminSections2.staff')
        ]);
    }


    // public function items(Request $request)
    // {
    //     if ($request->header('HX-Request')) {
    //         return view('adminSections2.items');
    //     }

    //     return view('layouts.admin', [
    //         'title' => 'Items',
    //         'content' => view('adminSections2.items')
    //     ]);
    // }

    // public function items(Request $request)
    // {
    //     $items = LaundryItem::with('category')->orderBy('name')->paginate(5);
    //     $categories = LaundryCategory::orderBy('type')->get();

    //     if ($request->header('HX-Request')) {
    //         return view('adminSections2.items', compact('items', 'categories'));
    //     }

    //     return view('layouts.admin', [
    //         'title'   => 'Items',
    //         'content' => view('adminSections2.items', compact('items', 'categories'))
    //     ]);
    // }
    public function items(Request $request)
    {
        // Get all categories
        $categories = LaundryCategory::orderBy('type')->get();

        // Base query for laundry items
        $itemsQuery = LaundryItem::with('category')->orderBy('name');

        // Only active items for customers
        if (auth()->user()->role === 'customer') {
            $itemsQuery->where('is_active', 1);
        }


        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;

            $itemsQuery->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('category', function ($q2) use ($search) {
                        $q2->where('type', 'LIKE', "%{$search}%");
                    });
            });
        }

        // Paginate results
        $items = $itemsQuery->latest()->paginate(2)->withQueryString();

        // Check for HTMX request
        if ($request->header('HX-Request')) {
            return view('adminSections2.items', compact('items', 'categories'));
        }

        // Full page load
        return view('layouts.admin', [
            'title'   => 'Items',
            'content' => view('adminSections2.items', compact('items', 'categories'))
        ]);
    }




    public function payments(Request $request)
    {
        // Start query with eager loading of order and customer
        $query = Payment::with(['order.customer']);

        // Restrict for customers
        if (auth()->user()->role === 'customer') {
            $query->whereHas('order', function ($q) {
                $q->where('customer_id', auth()->id());
            });
        }


        // Text search (reference, customer name, status)
        if ($request->filled('search_text')) {
            $search = strtolower($request->search_text);

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(reference) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('order.customer', function ($c) use ($search) {
                        $c->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                    })
                    ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"]);
            });
        }

        // Date range filter
        if ($request->filled('from_date')) {
            $query->whereDate(
                'created_at',
                '>=',
                Carbon::parse($request->from_date)->startOfDay()
            );
        }

        if ($request->filled('to_date')) {
            $query->whereDate(
                'created_at',
                '<=',
                Carbon::parse($request->to_date)->endOfDay()
            );
        }

        // Paginate results
        $payments = $query->latest()
            ->paginate(5)
            ->withQueryString();

        // HTMX request: return only the payments table
        if ($request->header('HX-Request')) {
            return view('adminSections2.payments', compact('payments'));
        }

        // Normal request: wrap in layout
        return view('layouts.admin', [
            'title'   => 'Payments',
            'content' => view('adminSections2.payments', compact('payments'))
        ]);
    }
}
