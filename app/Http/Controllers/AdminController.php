<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaundryCategory;
use App\Models\LaundryItem;
use App\Models\LaundryOrder;
use App\Models\User;
use App\Models\Payment;
use App\Models\Branch;
use Carbon\Carbon;


// class AdminController extends Controller
// {

//     // this block is what calls the partial pages into the admin main-area using HX-Request

//     public function dashboard(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections.dashboard'); // partial
//         }

//         return view('layouts.admin', [
//             'title' => 'Dashboard',
//             'content' => view('adminSections.dashboard')
//         ]);
//     }


//     public function superAdmin(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections2.superAdmin'); // partial only
//         }

//         return view('layouts.admin', [
//             'title' => 'Super-Admin',
//             'content' => view('adminSections2.superAdmin')
//         ]);
//     }



//     public function admin(Request $request)
//     {


//         if ($request->header('HX-Request')) {
//             return view('adminSections2.admin'); // partial only
//         }

//         return view('layouts.admin', [
//             'title' => 'Admin',
//             'content' => view('adminSections2.admin')
//         ]);
//     }

//     public function customers(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections2.customers'); // partial only
//         }

//         return view('layouts.admin', [
//             'title' => 'Customers',
//             'content' => view('adminSections2.customers')
//         ]);
//     }

//     public function bookLaundry(Request $request)
//     {
//         $items = LaundryItem::with('category')->orderBy('name')->get();
//         $customers = User::where('role', 'customer')
//             ->orderBy('name')
//             ->get();
//         if ($request->header('HX-Request')) {
//             return view('adminSections2.bookLaundry', compact('customers', 'items'));
//         }

//         return view('layouts.admin', [
//             'title' => 'bookLaundry',
//             'content' => view('adminSections2.bookLaundry', compact('customers', 'items'))
//         ]);
//     }

//     public function branches(Request $request)
//     {
//         $branches = Branch::latest()->get();
//         $admins = User::where('role', 'admin')->orderBy('name')->get();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.branches', compact('branches', 'admins'));
//         }

//         return view('layouts.admin', [
//             'title' => 'branches',
//             'content' => view('adminSections2.branches', compact('branches', 'admins'))
//         ]);
//     }


//     public function history(Request $request)
//     {
//         $query = LaundryOrder::with(['customer', 'items', 'createdBy'])
//             ->whereIn('status', ['completed', 'delivered']);

//         // Restrict for customers
//         if (auth()->user()->role === 'customer') {
//             $query->where('customer_id', auth()->id());
//         }


//         //  Text search
//         if ($request->filled('q')) {
//             $search = strtolower($request->q);

//             $query->where(function ($q) use ($search) {
//                 $q->whereHas('customer', function ($c) use ($search) {
//                     $c->where('name', 'LIKE', "%{$search}%");
//                 })
//                     ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"]);
//             });
//         }

//         // Month filter (YYYY-MM)
//         if ($request->filled('month')) {
//             [$year, $month] = explode('-', $request->month);

//             $query->whereYear('created_at', $year)
//                 ->whereMonth('created_at', $month);
//         }

//         $orders = $query->latest()
//             ->paginate(5)
//             ->withQueryString();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.history', compact('orders'));
//         }

//         return view('layouts.admin', [
//             'title' => 'History',
//             'content' => view('adminSections2.history', compact('orders')),
//         ]);
//     }


//     public function notifications(Request $request)
//     {

//         $notifications = auth()->user()
//             ->notifications()
//             ->latest()
//             ->paginate(10);

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.notifications', compact('notifications'));
//         }

//         return view('layouts.admin', [
//             'title' => 'Notifications',
//             'content' => view('adminSections2.notifications', compact('notifications'))
//         ]);
//     }

//     public function profile(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections.profile');
//         }

//         return view('layouts.admin', [
//             'title' => 'Profile',
//             'content' => view('adminSections.profile')
//         ]);
//     }

//     public function preferences(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections2.preferences');
//         }

//         return view('layouts.admin', [
//             'title' => 'Preferences',
//             'content' => view('adminSections2.preferences')
//         ]);
//     }



//     public function orderTrack(Request $request)
//     {
//         $query = LaundryOrder::with(['customer', 'items', 'createdBy', 'branch']);

//         // Restrict for customers
//         if (auth()->user()->role === 'customer') {
//             $query->where('customer_id', auth()->id());
//         }

//         // Text search — customer name, status, branch name, or invoice number
//         if ($request->filled('q')) {
//             $search = strtolower($request->q);

//             // Strip INV- prefix if user searches "INV-0005" or "inv-0005"
//             $numericSearch = preg_replace('/^inv-0*/i', '', $request->q);

//             $query->where(function ($q) use ($search, $numericSearch) {
//                 $q->whereHas('customer', function ($c) use ($search) {
//                     $c->where('name', 'LIKE', "%{$search}%");
//                 })
//                     ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
//                     ->orWhereHas('branch', function ($b) use ($search) {
//                         $b->where('name', 'LIKE', "%{$search}%");
//                     })
//                     ->orWhere('id', 'LIKE', "%{$numericSearch}%");
//             });
//         }

//         $orders = $query->latest()
//             ->paginate(5)
//             ->withQueryString();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.orderTrack', compact('orders'));
//         }

//         return view('layouts.admin', [
//             'title' => 'History',
//             'content' => view('adminSections2.orderTrack', compact('orders')),
//         ]);
//     }


//     public function staff(Request $request)
//     {

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.staff');
//         }

//         return view('layouts.admin', [
//             'title' => 'Staff',
//             'content' => view('adminSections2.staff', compact('branches'))
//         ]);
//     }



//     public function items(Request $request)
//     {
//         // Get all categories
//         $categories = LaundryCategory::orderBy('type')->get();

//         // Base query for laundry items
//         // $itemsQuery = LaundryItem::with('category')->orderBy('name');
//         $itemsQuery = LaundryItem::with('category');


//         // Only active items for customers
//         if (auth()->user()->role === 'customer') {
//             $itemsQuery->where('is_active', 1);
//         }


//         // Apply search filter
//         if ($request->filled('search')) {
//             $search = $request->search;

//             $itemsQuery->where(function ($q) use ($search) {
//                 $q->where('name', 'LIKE', "%{$search}%")
//                     ->orWhereHas('category', function ($q2) use ($search) {
//                         $q2->where('type', 'LIKE', "%{$search}%");
//                     });
//             });
//         }

//         // Paginate results
//         $items = $itemsQuery->latest()->paginate(5)->withQueryString();

//         // Check for HTMX request
//         if ($request->header('HX-Request')) {
//             return view('adminSections2.items', compact('items', 'categories'));
//         }

//         // Full page load
//         return view('layouts.admin', [
//             'title'   => 'Items',
//             'content' => view('adminSections2.items', compact('items', 'categories'))
//         ]);
//     }


//     public function category(Request $request)
//     {
//         $categories = LaundryCategory::orderBy('type')->get();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.category', compact('categories'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'Category',
//             'content' => view('adminSections2.category', compact('categories'))
//         ]);
//     }



//     public function payments(Request $request)
//     {
//         $query = Payment::with(['order.customer', 'order.branch']);

//         // Restrict for customers
//         if (auth()->user()->role === 'customer') {
//             $query->whereHas('order', function ($q) {
//                 $q->where('customer_id', auth()->id());
//             });
//         }

//         // Text search — reference, customer name, status, or invoice number
//         if ($request->filled('search_text')) {
//             $search = strtolower($request->search_text);

//             // Strip # prefix so "#CASH-XXX" matches "CASH-XXX" in the database
//             $search = ltrim($search, '#');

//             // Strip INV- prefix so searching "INV-0005" matches order id 5
//             $numericSearch = preg_replace('/^inv-0*/i', '', $request->search_text);

//             $query->where(function ($q) use ($search, $numericSearch) {
//                 $q->whereRaw('LOWER(reference) LIKE ?', ["%{$search}%"])
//                     ->orWhereHas('order.customer', function ($c) use ($search) {
//                         $c->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
//                     })
//                     ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
//                     ->orWhereHas('order', function ($o) use ($numericSearch) {
//                         $o->where('id', 'LIKE', "%{$numericSearch}%");
//                     });
//             });
//         }

//         // Date range filter
//         if ($request->filled('from_date')) {
//             $query->whereDate(
//                 'created_at',
//                 '>=',
//                 Carbon::parse($request->from_date)->startOfDay()
//             );
//         }

//         if ($request->filled('to_date')) {
//             $query->whereDate(
//                 'created_at',
//                 '<=',
//                 Carbon::parse($request->to_date)->endOfDay()
//             );
//         }

//         $payments = $query->latest()
//             ->paginate(5)
//             ->withQueryString();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.payments', compact('payments'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'Payments',
//             'content' => view('adminSections2.payments', compact('payments'))
//         ]);
//     }
// }

// class AdminController extends Controller
// {
//     // ── Helper: check if current user should be branch-filtered ──
//     private function isBranchRestricted(): bool
//     {
//         return in_array(auth()->user()->role, ['admin', 'staff']);
//     }

//     private function userBranchId(): ?int
//     {
//         return auth()->user()->branch_id;
//     }

//     // ─────────────────────────────────────────────────────────────

//     public function dashboard(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections.dashboard');
//         }

//         return view('layouts.admin', [
//             'title'   => 'Dashboard',
//             'content' => view('adminSections.dashboard')
//         ]);
//     }

//     public function superAdmin(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections2.superAdmin');
//         }

//         return view('layouts.admin', [
//             'title'   => 'Super-Admin',
//             'content' => view('adminSections2.superAdmin')
//         ]);
//     }

//     public function admin(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections2.admin');
//         }

//         return view('layouts.admin', [
//             'title'   => 'Admin',
//             'content' => view('adminSections2.admin')
//         ]);
//     }

//     public function customers(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections2.customers');
//         }

//         return view('layouts.admin', [
//             'title'   => 'Customers',
//             'content' => view('adminSections2.customers')
//         ]);
//     }

//     public function bookLaundry(Request $request)
//     {
//         $items     = LaundryItem::with('category')->orderBy('name')->get();
//         $customers = User::where('role', 'customer')->orderBy('name')->get();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.bookLaundry', compact('customers', 'items'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'bookLaundry',
//             'content' => view('adminSections2.bookLaundry', compact('customers', 'items'))
//         ]);
//     }

//     public function branches(Request $request)
//     {
//         $branches = Branch::latest()->get();
//         $admins   = User::where('role', 'admin')->orderBy('name')->get();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.branches', compact('branches', 'admins'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'branches',
//             'content' => view('adminSections2.branches', compact('branches', 'admins'))
//         ]);
//     }

//     public function history(Request $request)
//     {
//         $query = LaundryOrder::with(['customer', 'items', 'createdBy', 'branch'])
//             ->whereIn('status', ['completed', 'delivered']);

//         // Customers see only their own orders
//         if (auth()->user()->role === 'customer') {
//             $query->where('customer_id', auth()->id());
//         }

//         // Admins & staff see only their branch
//         if ($this->isBranchRestricted()) {
//             $query->where('branch_id', $this->userBranchId());
//         }

//         if ($request->filled('q')) {
//             $search        = strtolower($request->q);
//             $numericSearch = preg_replace('/^inv-0*/i', '', $request->q);

//             $query->where(function ($q) use ($search, $numericSearch) {
//                 $q->whereHas('customer', function ($c) use ($search) {
//                     $c->where('name', 'LIKE', "%{$search}%");
//                 })
//                     ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
//                     ->orWhereHas('branch', function ($b) use ($search) {
//                         $b->where('name', 'LIKE', "%{$search}%");
//                     })
//                     ->orWhere('id', 'LIKE', "%{$numericSearch}%");
//             });
//         }

//         if ($request->filled('month')) {
//             [$year, $month] = explode('-', $request->month);
//             $query->whereYear('created_at', $year)
//                 ->whereMonth('created_at', $month);
//         }

//         $orders = $query->latest()->paginate(5)->withQueryString();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.history', compact('orders'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'History',
//             'content' => view('adminSections2.history', compact('orders')),
//         ]);
//     }

//     public function notifications(Request $request)
//     {
//         $notifications = auth()->user()
//             ->notifications()
//             ->latest()
//             ->paginate(10);

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.notifications', compact('notifications'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'Notifications',
//             'content' => view('adminSections2.notifications', compact('notifications'))
//         ]);
//     }

//     public function profile(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections.profile');
//         }

//         return view('layouts.admin', [
//             'title'   => 'Profile',
//             'content' => view('adminSections.profile')
//         ]);
//     }

//     public function preferences(Request $request)
//     {
//         if ($request->header('HX-Request')) {
//             return view('adminSections2.preferences');
//         }

//         return view('layouts.admin', [
//             'title'   => 'Preferences',
//             'content' => view('adminSections2.preferences')
//         ]);
//     }

//     public function orderTrack(Request $request)
//     {
//         $query = LaundryOrder::with(['customer', 'items', 'createdBy', 'branch']);

//         // Customers see only their own orders
//         if (auth()->user()->role === 'customer') {
//             $query->where('customer_id', auth()->id());
//         }

//         // Admins & staff see only their branch
//         if ($this->isBranchRestricted()) {
//             $query->where('branch_id', $this->userBranchId());
//         }

//         if ($request->filled('q')) {
//             $search        = strtolower($request->q);
//             $numericSearch = preg_replace('/^inv-0*/i', '', $request->q);

//             $query->where(function ($q) use ($search, $numericSearch) {
//                 $q->whereHas('customer', function ($c) use ($search) {
//                     $c->where('name', 'LIKE', "%{$search}%");
//                 })
//                     ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
//                     ->orWhereHas('branch', function ($b) use ($search) {
//                         $b->where('name', 'LIKE', "%{$search}%");
//                     })
//                     ->orWhere('id', 'LIKE', "%{$numericSearch}%");
//             });
//         }

//         $orders = $query->latest()->paginate(5)->withQueryString();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.orderTrack', compact('orders'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'OrderTrack',
//             'content' => view('adminSections2.orderTrack', compact('orders')),
//         ]);
//     }

//     public function staff(Request $request)
//     {
//         $branches = Branch::where('is_active', true)->orderBy('name')->get();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.staff', compact('branches'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'Staff',
//             'content' => view('adminSections2.staff', compact('branches'))
//         ]);
//     }

//     public function items(Request $request)
//     {
//         $categories = LaundryCategory::orderBy('type')->get();
//         $itemsQuery = LaundryItem::with('category');

//         // Only active items for customers
//         if (auth()->user()->role === 'customer') {
//             $itemsQuery->where('is_active', 1);
//         }

//         if ($request->filled('search')) {
//             $search = $request->search;
//             $itemsQuery->where(function ($q) use ($search) {
//                 $q->where('name', 'LIKE', "%{$search}%")
//                     ->orWhereHas('category', function ($q2) use ($search) {
//                         $q2->where('type', 'LIKE', "%{$search}%");
//                     });
//             });
//         }

//         $items = $itemsQuery->latest()->paginate(5)->withQueryString();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.items', compact('items', 'categories'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'Items',
//             'content' => view('adminSections2.items', compact('items', 'categories'))
//         ]);
//     }

//     public function category(Request $request)
//     {
//         $categories = LaundryCategory::orderBy('type')->get();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.category', compact('categories'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'Category',
//             'content' => view('adminSections2.category', compact('categories'))
//         ]);
//     }

//     public function payments(Request $request)
//     {
//         $query = Payment::with(['order.customer', 'order.branch']);

//         // Customers see only their own payments
//         if (auth()->user()->role === 'customer') {
//             $query->whereHas('order', function ($q) {
//                 $q->where('customer_id', auth()->id());
//             });
//         }

//         // Admins & staff see only payments from their branch
//         if ($this->isBranchRestricted()) {
//             $query->whereHas('order', function ($q) {
//                 $q->where('branch_id', $this->userBranchId());
//             });
//         }

//         if ($request->filled('search_text')) {
//             $search        = ltrim(strtolower($request->search_text), '#');
//             $numericSearch = preg_replace('/^inv-0*/i', '', $request->search_text);

//             $query->where(function ($q) use ($search, $numericSearch) {
//                 $q->whereRaw('LOWER(reference) LIKE ?', ["%{$search}%"])
//                     ->orWhereHas('order.customer', function ($c) use ($search) {
//                         $c->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
//                     })
//                     ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
//                     ->orWhereHas('order', function ($o) use ($numericSearch) {
//                         $o->where('id', 'LIKE', "%{$numericSearch}%");
//                     });
//             });
//         }

//         if ($request->filled('from_date')) {
//             $query->whereDate('created_at', '>=', Carbon::parse($request->from_date)->startOfDay());
//         }

//         if ($request->filled('to_date')) {
//             $query->whereDate('created_at', '<=', Carbon::parse($request->to_date)->endOfDay());
//         }

//         $payments = $query->latest()->paginate(5)->withQueryString();

//         if ($request->header('HX-Request')) {
//             return view('adminSections2.payments', compact('payments'));
//         }

//         return view('layouts.admin', [
//             'title'   => 'Payments',
//             'content' => view('adminSections2.payments', compact('payments'))
//         ]);
//     }
// }





class AdminController extends Controller
{
    // ── Helper: check if current user should be branch-filtered ──
    private function isBranchRestricted(): bool
    {
        return in_array(auth()->user()->role, ['admin', 'staff']);
    }

    private function userBranchId(): ?int
    {
        return auth()->user()->branch_id;
    }

    // ─────────────────────────────────────────────────────────────

    // public function dashboard(Request $request)
    // {
    //     if ($request->header('HX-Request')) {
    //         return view('adminSections.dashboard');
    //     }

    //     return view('layouts.admin', [
    //         'title'   => 'Dashboard',
    //         'content' => view('adminSections.dashboard')
    //     ]);
    // }

    public function dashboard(Request $request)
    {

        // Customers have their own dashboard
        if (auth()->user()->role === 'customer') {
            return redirect()->route('customerDashboard');
        }

        $isBranchRestricted = $this->isBranchRestricted();
        $branchId           = $this->userBranchId();

        // ── Base order query ──────────────────────────────────────
        $orderBase = LaundryOrder::query();
        if ($isBranchRestricted) {
            $orderBase->where('branch_id', $branchId);
        }

        // ── Stat cards ────────────────────────────────────────────
        $totalOrders      = (clone $orderBase)->count();
        $totalRevenue     = (clone $orderBase)->sum('amount_paid');
        $totalCustomers   = User::where('role', 'customer')->count();
        $totalStaff       = User::where('role', 'staff')
            ->when($isBranchRestricted, fn($q) => $q->where('branch_id', $branchId))
            ->count();
        $pendingOrders    = (clone $orderBase)->where('status', 'pending')->count();
        $completedOrders  = (clone $orderBase)->whereIn('status', ['completed', 'delivered'])->count();
        $todaysOrders     = (clone $orderBase)->whereDate('created_at', Carbon::today())->count();
        $outstandingBal   = (clone $orderBase)->whereIn('payment_status', ['pending', 'partial'])
            ->selectRaw('SUM(total_amount - amount_paid) as balance')
            ->value('balance') ?? 0;

        // ── Last 30 days — orders per day (bar chart) ─────────────
        $ordersLast30 = (clone $orderBase)
            ->where('created_at', '>=', Carbon::now()->subDays(29)->startOfDay())
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count', 'date');

        // Fill in missing days with 0
        $orderDates  = [];
        $orderCounts = [];
        for ($i = 29; $i >= 0; $i--) {
            $date          = Carbon::now()->subDays($i)->format('Y-m-d');
            $orderDates[]  = Carbon::now()->subDays($i)->format('M d');
            $orderCounts[] = $ordersLast30[$date] ?? 0;
        }

        // ── Last 30 days — revenue per day (line chart) ───────────
        $revenueLast30 = (clone $orderBase)
            ->where('created_at', '>=', Carbon::now()->subDays(29)->startOfDay())
            ->selectRaw('DATE(created_at) as date, SUM(amount_paid) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date');

        $revenueCounts = [];
        for ($i = 29; $i >= 0; $i--) {
            $date            = Carbon::now()->subDays($i)->format('Y-m-d');
            $revenueCounts[] = $revenueLast30[$date] ?? 0;
        }

        // ── Order status breakdown (donut) ────────────────────────
        $statusBreakdown = (clone $orderBase)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        // ── Payment method breakdown (donut) ─────────────────────
        $methodBreakdown = Payment::selectRaw('method, COUNT(*) as count')
            ->when($isBranchRestricted, fn($q) => $q->whereHas('order', fn($o) => $o->where('branch_id', $branchId)))
            ->groupBy('method')
            ->pluck('count', 'method');

        // ── Recent 5 orders ───────────────────────────────────────
        $recentOrders = (clone $orderBase)
            ->with(['customer', 'branch'])
            ->latest()
            ->take(5)
            ->get();

        if ($request->header('HX-Request')) {
            return view('adminSections2.dashboard', compact(
                'totalOrders',
                'totalRevenue',
                'totalCustomers',
                'totalStaff',
                'pendingOrders',
                'completedOrders',
                'todaysOrders',
                'outstandingBal',
                'orderDates',
                'orderCounts',
                'revenueCounts',
                'statusBreakdown',
                'methodBreakdown',
                'recentOrders'
            ));
        }

        return view('layouts.admin', [
            'title'   => 'Dashboard',
            'content' => view('adminSections2.dashboard', compact(
                'totalOrders',
                'totalRevenue',
                'totalCustomers',
                'totalStaff',
                'pendingOrders',
                'completedOrders',
                'todaysOrders',
                'outstandingBal',
                'orderDates',
                'orderCounts',
                'revenueCounts',
                'statusBreakdown',
                'methodBreakdown',
                'recentOrders'
            ))
        ]);
    }


    // ── Customer Dashboard ────────────────────────────────────────
    public function customerDashboard(Request $request)
    {
        $customerId = auth()->id();

        $totalOrders   = LaundryOrder::where('customer_id', $customerId)->count();
        $totalSpent    = LaundryOrder::where('customer_id', $customerId)->sum('amount_paid');
        $activeOrders  = LaundryOrder::where('customer_id', $customerId)
            ->whereIn('status', ['pending', 'In progress'])
            ->count();
        $outstandingBal = LaundryOrder::where('customer_id', $customerId)
            ->whereIn('payment_status', ['pending', 'partial'])
            ->selectRaw('SUM(total_amount - amount_paid) as balance')
            ->value('balance') ?? 0;

        $activeOrdersList = LaundryOrder::where('customer_id', $customerId)
            ->whereIn('status', ['pending', 'In progress'])
            ->with('items')
            ->latest()
            ->take(5)
            ->get();

        $recentHistory = LaundryOrder::where('customer_id', $customerId)
            ->whereIn('status', ['completed', 'delivered'])
            ->latest()
            ->take(5)
            ->get();

        $data = compact(
            'totalOrders',
            'totalSpent',
            'activeOrders',
            'outstandingBal',
            'activeOrdersList',
            'recentHistory'
        );

        if ($request->header('HX-Request')) {
            return view('adminSections2.customerDashboard', $data);
        }

        return view('layouts.admin', [
            'title'   => 'My Dashboard',
            'content' => view('adminSections2.customerDashboard', $data)
        ]);
    }

    public function superAdmin(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections2.superAdmin');
        }

        return view('layouts.admin', [
            'title'   => 'Super-Admin',
            'content' => view('adminSections2.superAdmin')
        ]);
    }

    public function admin(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections2.admin');
        }

        return view('layouts.admin', [
            'title'   => 'Admin',
            'content' => view('adminSections2.admin')
        ]);
    }

    public function customers(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections2.customers');
        }

        return view('layouts.admin', [
            'title'   => 'Customers',
            'content' => view('adminSections2.customers')
        ]);
    }

    public function bookLaundry(Request $request)
    {
        $items     = LaundryItem::with('category')->orderBy('name')->get();
        $customers = User::where('role', 'customer')->orderBy('name')->get();

        if ($request->header('HX-Request')) {
            return view('adminSections2.bookLaundry', compact('customers', 'items'));
        }

        return view('layouts.admin', [
            'title'   => 'bookLaundry',
            'content' => view('adminSections2.bookLaundry', compact('customers', 'items'))
        ]);
    }

    // public function branches(Request $request)
    // {
    //     $branches = Branch::latest()->get();
    //     $admins   = User::where('role', 'admin')->orderBy('name')->get();

    //     if ($request->header('HX-Request')) {
    //         return view('adminSections2.branches', compact('branches', 'admins'));
    //     }

    //     return view('layouts.admin', [
    //         'title'   => 'branches',
    //         'content' => view('adminSections2.branches', compact('branches', 'admins'))
    //     ]);
    // }

   public function branches(Request $request)
    {
        $branches = Branch::with('manager')->latest()->get();

        // Group admins by branch_id so each branch only sees its own admins
        $adminsByBranch = User::where('role', 'admin')
            ->whereNotNull('branch_id')
            ->orderBy('name')
            ->get()
            ->groupBy('branch_id');

        if ($request->header('HX-Request')) {
            return view('adminSections2.branches', compact('branches', 'adminsByBranch'));
        }

        return view('layouts.admin', [
            'title'   => 'branches',
            'content' => view('adminSections2.branches', compact('branches', 'adminsByBranch'))
        ]);
    }

    public function history(Request $request)
    {
        $query = LaundryOrder::with(['customer', 'items', 'createdBy', 'branch'])
            ->whereIn('status', ['completed', 'delivered']);

        // Customers see only their own orders
        if (auth()->user()->role === 'customer') {
            $query->where('customer_id', auth()->id());
        }

        // Admins & staff see only their branch
        if ($this->isBranchRestricted()) {
            $query->where('branch_id', $this->userBranchId());
        }

        if ($request->filled('q')) {
            $search        = strtolower($request->q);
            $numericSearch = preg_replace('/^inv-0*/i', '', $request->q);

            $query->where(function ($q) use ($search, $numericSearch) {
                $q->whereHas('customer', function ($c) use ($search) {
                    $c->where('name', 'LIKE', "%{$search}%");
                })
                    ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('branch', function ($b) use ($search) {
                        $b->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhere('id', 'LIKE', "%{$numericSearch}%");
            });
        }

        if ($request->filled('month')) {
            [$year, $month] = explode('-', $request->month);
            $query->whereYear('created_at', $year)
                ->whereMonth('created_at', $month);
        }

        $orders = $query->latest()->paginate(5)->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.history', compact('orders'));
        }

        return view('layouts.admin', [
            'title'   => 'History',
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
            'title'   => 'Notifications',
            'content' => view('adminSections2.notifications', compact('notifications'))
        ]);
    }

    public function profile(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections.profile');
        }

        return view('layouts.admin', [
            'title'   => 'Profile',
            'content' => view('adminSections.profile')
        ]);
    }

    public function preferences(Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('adminSections2.preferences');
        }

        return view('layouts.admin', [
            'title'   => 'Preferences',
            'content' => view('adminSections2.preferences')
        ]);
    }

    public function orderTrack(Request $request)
    {
        $query = LaundryOrder::with(['customer', 'items', 'createdBy', 'branch']);

        // Customers see only their own orders
        if (auth()->user()->role === 'customer') {
            $query->where('customer_id', auth()->id());
        }

        // Admins & staff see only their branch
        if ($this->isBranchRestricted()) {
            $query->where('branch_id', $this->userBranchId());
        }

        if ($request->filled('q')) {
            $search        = strtolower($request->q);
            $numericSearch = preg_replace('/^inv-0*/i', '', $request->q);

            $query->where(function ($q) use ($search, $numericSearch) {
                $q->whereHas('customer', function ($c) use ($search) {
                    $c->where('name', 'LIKE', "%{$search}%");
                })
                    ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('branch', function ($b) use ($search) {
                        $b->where('name', 'LIKE', "%{$search}%");
                    })
                    ->orWhere('id', 'LIKE', "%{$numericSearch}%");
            });
        }

        $orders = $query->latest()->paginate(5)->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.orderTrack', compact('orders'));
        }

        return view('layouts.admin', [
            'title'   => 'OrderTrack',
            'content' => view('adminSections2.orderTrack', compact('orders')),
        ]);
    }

    public function staff(Request $request)
    {
        $branches = Branch::where('is_active', true)->orderBy('name')->get();

        if ($request->header('HX-Request')) {
            return view('adminSections2.staff', compact('branches'));
        }

        return view('layouts.admin', [
            'title'   => 'Staff',
            'content' => view('adminSections2.staff', compact('branches'))
        ]);
    }

    public function items(Request $request)
    {
        $categories = LaundryCategory::orderBy('type')->get();
        $itemsQuery = LaundryItem::with('category');

        // Only active items for customers
        if (auth()->user()->role === 'customer') {
            $itemsQuery->where('is_active', 1);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $itemsQuery->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhereHas('category', function ($q2) use ($search) {
                        $q2->where('type', 'LIKE', "%{$search}%");
                    });
            });
        }

        $items = $itemsQuery->latest()->paginate(5)->withQueryString();

        if ($request->header('HX-Request')) {
            return view('adminSections2.items', compact('items', 'categories'));
        }

        return view('layouts.admin', [
            'title'   => 'Items',
            'content' => view('adminSections2.items', compact('items', 'categories'))
        ]);
    }

    public function category(Request $request)
    {
        $categories = LaundryCategory::orderBy('type')->get();

        if ($request->header('HX-Request')) {
            return view('adminSections2.category', compact('categories'));
        }

        return view('layouts.admin', [
            'title'   => 'Category',
            'content' => view('adminSections2.category', compact('categories'))
        ]);
    }


    public function payments(Request $request)
    {
        $query = Payment::with(['order.customer', 'order.branch']);

        // Customers see only their own payments
        if (auth()->user()->role === 'customer') {
            $query->whereHas('order', function ($q) {
                $q->where('customer_id', auth()->id());
            });
        }

        // Admins & staff see only payments from their branch
        if ($this->isBranchRestricted()) {
            $query->whereHas('order', function ($q) {
                $q->where('branch_id', $this->userBranchId());
            });
        }

        if ($request->filled('search_text')) {
            $search        = ltrim(strtolower($request->search_text), '#');
            $numericSearch = preg_replace('/^inv-0*/i', '', $request->search_text);

            $query->where(function ($q) use ($search, $numericSearch) {
                $q->whereRaw('LOWER(reference) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('order.customer', function ($c) use ($search) {
                        $c->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"]);
                    })
                    ->orWhereRaw('LOWER(status) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('order', function ($o) use ($numericSearch) {
                        $o->where('id', 'LIKE', "%{$numericSearch}%");
                    });
            });
        }

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->from_date)->startOfDay());
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->to_date)->endOfDay());
        }

        // ── Stats — run on a fresh base query (no search/date filters) ──
        // so they always reflect true totals regardless of what's being searched
        $statsBase = Payment::where('status', 'success');

        if (auth()->user()->role === 'customer') {
            $statsBase->whereHas('order', fn($q) => $q->where('customer_id', auth()->id()));
        }
        if ($this->isBranchRestricted()) {
            $statsBase->whereHas('order', fn($q) => $q->where('branch_id', $this->userBranchId()));
        }

        $totalAllTime = (clone $statsBase)->sum('amount');
        $totalToday   = (clone $statsBase)->whereDate('created_at', Carbon::today())->sum('amount');
        $totalWeek    = (clone $statsBase)->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('amount');
        $totalMonth   = (clone $statsBase)->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('amount');
        $totalPending = \App\Models\LaundryOrder::whereIn('payment_status', ['pending', 'partial'])
            ->when($this->isBranchRestricted(), fn($q) => $q->where('branch_id', $this->userBranchId()))
            ->when(auth()->user()->role === 'customer', fn($q) => $q->where('customer_id', auth()->id()))
            ->selectRaw('SUM(total_amount - amount_paid) as balance')
            ->value('balance') ?? 0;
        $totalFailed  = Payment::where('status', 'failed')->count();

        $payments = $query->latest()->paginate(5)->withQueryString();

        $data = compact('payments', 'totalAllTime', 'totalToday', 'totalWeek', 'totalMonth', 'totalPending', 'totalFailed');

        if ($request->header('HX-Request')) {
            return view('adminSections2.payments', $data);
        }

        return view('layouts.admin', [
            'title'   => 'Payments',
            'content' => view('adminSections2.payments', $data)
        ]);
    }
}
