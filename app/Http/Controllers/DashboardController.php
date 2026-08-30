<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Furniture;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $monthExpression = DB::connection()->getDriverName() === 'sqlite'
            ? 'strftime("%m", created_at)'
            : 'MONTH(created_at)';

        $salesByMonth = Order::query()
            ->selectRaw("{$monthExpression} as month, SUM(total) as total")
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('total', 'month');

        $monthlySales = collect(range(1, 12))->map(
            fn (int $month): float => (float) ($salesByMonth[$month]
                ?? $salesByMonth[str_pad((string) $month, 2, '0', STR_PAD_LEFT)]
                ?? 0)
        );

        return view('dashboard', [
            'stats' => [
                'furnitures' => Furniture::count(),
                'categories' => Category::count(),
                'customers' => Customer::count(),
                'orders' => Order::count(),
                'sales' => Order::sum('total'),
                'low_stock' => Furniture::where('quantity', '<=', 3)->count(),
            ],
            'monthlySales' => $monthlySales,
            'recentOrders' => Order::with('customer')->latest()->take(5)->get(),
            'lowStockItems' => Furniture::with('category')
                ->where('quantity', '<=', 3)
                ->take(5)
                ->get(),
        ]);
    }
}
