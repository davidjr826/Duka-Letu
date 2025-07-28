<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Flasher\Notyf\Laravel\Facade\Notyf;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Inventory;
use Carbon\Carbon;

class HomeController extends Controller
{
    // showWelcomePage
    public function login() {
        return view('auth.login');
    }



public function adminDashboard()
    {
        $user = auth()->user();
        
        // Redirect if not logged in
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Redirect if not admin
        if (!$user->isAdmin()) {
            Notyf::error('You do not have permission to access this page.');
            return redirect()->route('home');
        }

        // Today's date
        $today = Carbon::today()->toDateString();
        
        // Sales Summary
        $salesSummary = $this->getSalesSummary($today);
        
        // Low Stock Products
        $lowStockProducts = Inventory::with('product')
            ->where('quantity', '<', 5)
            ->orderBy('quantity')
            ->limit(5)
            ->get();
        
        // Recent Sales
        $recentSales = Sale::withCount('items')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Product Count
        $productCount = Product::count();
        
        // Monthly Sales Data (for charts)
        $monthlySales = $this->getMonthlySalesData();
        
        // Daily Sales Data (for charts)
        $dailySales = $this->getDailySalesData();

        // **Top-Selling Products (Fixed GROUP BY issue)**
        $topSalesProducts = Product::select([
            'products.id',
            'products.name as product_name',
            'products.description',
            'products.cost_price as buying_price',
            'products.price as selling_price',
            'products.quantity as quantity_in_stock',
            DB::raw('SUM(sale_items.quantity) as total_sold') // Total sold count
        ])
        ->leftJoin('sale_items', 'products.id', '=', 'sale_items.product_id')
        ->groupBy([
            'products.id',
            'products.name',
            'products.description',
            'products.cost_price',
            'products.price',
            'products.quantity'
        ])
        ->orderBy('total_sold', 'DESC')
        ->limit(5) // Top 5 best-sellers
        ->get();

        return view('admin.dashboard', compact(
            'salesSummary',
            'lowStockProducts',
            'user',
            'recentSales',
            'productCount',
            'monthlySales',
            'dailySales',
            'topSalesProducts' // Pass top-selling products to view
        ));
    }


private function calculateWeeklyGrowth()
{
    $currentWeek = Sale::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->sum('total_amount');
    
    $lastWeek = Sale::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
        ->sum('total_amount');
    
    return $lastWeek > 0 ? round(($currentWeek - $lastWeek) / $lastWeek * 100, 1) : 100;
}

private function calculateYearlyGrowth()
{
    $currentYear = Sale::whereYear('created_at', now()->year)
        ->sum('total_amount');
    
    $lastYear = Sale::whereYear('created_at', now()->subYear()->year)
        ->sum('total_amount');
    
    return $lastYear > 0 ? round(($currentYear - $lastYear) / $lastYear * 100, 1) : 100;
}



public function products()
{
    $user = auth()->user();
    $products = \App\Models\Product::with('category') // Eager load the category relationship
        ->select([
            'id',
            'name',
            'cost_price as buying',
            'price as selling',
            'quantity',
            'category_id'
        ])->get();

    $categories = \App\Models\Category::all(); // Fetch all categories

    return view('admin.products', [
        'user' => $user,
        'products' => $products,
        'categories' => $categories
    ]);
}


    public function welcome() 
    {
        return view('admin.products');
    }





// private function getSalesSummary($date)
// {
//     $sales = Sale::with(['items.product'])
//         ->whereDate('created_at', $date)
//         ->get();

//     $summary = [
//         'total_sales' => 0,
//         'total_paid' => 0,
//         'transactions' => $sales->count(),
//         'total_cost' => 0,
//         'profit' => 0,
//         'loans' => 0
//     ];

//     foreach ($sales as $sale) {
//         $summary['total_sales'] += $sale->total_amount;
//         $summary['total_paid'] += $sale->paid_amount;
//         $summary['loans'] += max(0, $sale->total_amount - $sale->paid_amount);
        
//         foreach ($sale->items as $item) {
//             $cost = $item->product 
//                 ? $item->quantity * $item->product->cost_price
//                 : $item->quantity * ($item->unit_price * 0.7); // Fallback
            
//             $summary['total_cost'] += $cost;
//         }
//     }

//     $summary['profit'] = $summary['total_sales'] - $summary['total_cost'];
    

//     return (object)$summary;
// }


private function getSalesSummary($date)
{
    $sales = Sale::with(['items.product'])
        ->whereDate('created_at', $date)
        ->get();

    $summary = [
        'total_sales' => 0,
        'total_paid' => 0,
        'transactions' => $sales->count(),
        'total_cost' => 0,
        'profit' => 0,
        'loans' => 0,
        'items_sold' => 0
    ];

    foreach ($sales as $sale) {
        $summary['total_sales'] += $sale->total_amount;
        $summary['total_paid'] += $sale->paid_amount;
        $summary['loans'] += max(0, $sale->total_amount - $sale->paid_amount);
        
        foreach ($sale->items as $item) {
            $summary['items_sold'] += $item->quantity;
            
            $cost = $item->product 
                ? $item->quantity * $item->product->cost_price
                : $item->quantity * ($item->unit_price * 0.7); // Fallback
            
            $summary['total_cost'] += $cost;
        }
    }

    $summary['profit'] = $summary['total_sales'] - $summary['total_cost'];
    
    return (object)$summary;
}



    private function getTopSellingProducts()
{
    $thirtyDaysAgo = Carbon::now()->subDays(30)->toDateString();
    
    return Product::select([
            'products.id',
            'products.name as product_name',
            'products.cost_price as buying_price',
            'products.price as selling_price',
            DB::raw('COALESCE(SUM(sale_items.quantity), 0) as total_sold'),
            DB::raw('(products.price - products.cost_price) * COALESCE(SUM(sale_items.quantity), 0) as total_profit')
        ])
        ->leftJoin('sale_items', 'products.id', '=', 'sale_items.product_id')
        ->leftJoin('sales', 'sale_items.sale_id', '=', 'sales.id')
        ->whereDate('sales.created_at', '>=', $thirtyDaysAgo)
        ->groupBy([
            'products.id',
            'products.name',
            'products.cost_price',
            'products.price'
        ])
        ->orderBy('total_sold', 'DESC')
        ->limit(5)
        ->get();
}



// private function getSalesSummary($date)
// {
//     $sales = Sale::with(['items.product'])
//         ->whereDate('created_at', $date)
//         ->get();

//     $summary = [
//         'total_sales' => 0,
//         'total_paid' => 0,
//         'transactions' => $sales->count(),
//         'total_cost' => 0,
//         'profit' => 0
//     ];

//     foreach ($sales as $sale) {
//         $summary['total_sales'] += $sale->total_amount;
//         $summary['total_paid'] += $sale->paid_amount;
        
//         foreach ($sale->items as $item) {
//             if ($item->product) {
//                 $summary['total_cost'] += $item->quantity * $item->product->cost_price;
//             }
//         }
//     }

//     $summary['profit'] = $summary['total_sales'] - $summary['total_cost'];

//     return (object)$summary;
// }






    // private function getMonthlySalesData()
    // {
    //     return Sale::selectRaw('
    //             YEAR(created_at) as year,
    //             MONTH(created_at) as month,
    //             SUM(total_amount) as total
    //         ')
    //         ->whereBetween('created_at', [now()->subMonths(11), now()])
    //         ->groupBy('year', 'month')
    //         ->orderBy('year')
    //         ->orderBy('month')
    //         ->get();
    // }


    private function getMonthlySalesData()
{
    $monthlyData = Sale::selectRaw('
            YEAR(created_at) as year,
            MONTH(created_at) as month,
            SUM(total_amount) as total
        ')
        ->whereBetween('created_at', [now()->subMonths(11), now()])
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

    // Fill in missing months with 0 values
    $result = [];
    for ($i = 11; $i >= 0; $i--) {
        $date = now()->subMonths($i);
        $found = $monthlyData->first(function ($item) use ($date) {
            return $item->year == $date->year && $item->month == $date->month;
        });
        
        $result[] = $found ?: (object)[
            'year' => $date->year,
            'month' => $date->month,
            'total' => 0
        ];
    }

    return collect($result);
}


private function getDailySalesData()
{
    $weekStart = now()->startOfWeek();
    $weekEnd = now()->endOfWeek();
    
    $dailyData = Sale::selectRaw('
            DAYNAME(created_at) as day,
            DAYOFWEEK(created_at) as day_order,
            SUM(total_amount) as total
        ')
        ->whereBetween('created_at', [$weekStart, $weekEnd])
        ->groupBy('day', 'day_order')
        ->orderBy('day_order')
        ->get();

    // Create a complete week structure with all days
    $daysOfWeek = [
        ['day' => 'Sunday', 'day_order' => 1, 'total' => 0],
        ['day' => 'Monday', 'day_order' => 2, 'total' => 0],
        ['day' => 'Tuesday', 'day_order' => 3, 'total' => 0],
        ['day' => 'Wednesday', 'day_order' => 4, 'total' => 0],
        ['day' => 'Thursday', 'day_order' => 5, 'total' => 0],
        ['day' => 'Friday', 'day_order' => 6, 'total' => 0],
        ['day' => 'Saturday', 'day_order' => 7, 'total' => 0],
    ];

    // Merge actual data with the complete week structure
    foreach ($dailyData as $data) {
        $index = $data->day_order - 1;
        if (isset($daysOfWeek[$index])) {
            $daysOfWeek[$index]['total'] = $data->total;
        }
    }

    return collect($daysOfWeek);
}




//     private function getDailySalesData()
// {
//     return Sale::selectRaw('
//             DAYNAME(created_at) as day,
//             DAYOFWEEK(created_at) as day_order,
//             SUM(total_amount) as total
//         ')
//         ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
//         ->groupBy('day', 'day_order')
//         ->orderBy('day_order')
//         ->get();
// }


private function thisWeekGrowth()
{
    $currentWeek = Sale::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
        ->sum('total_amount');
    
    $lastWeek = Sale::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
        ->sum('total_amount');
    
    return $lastWeek > 0 ? round(($currentWeek - $lastWeek) / $lastWeek * 100, 1) : 100;
}

private function yearlyGrowth()
{
    $currentYear = Sale::whereYear('created_at', now()->year)
        ->sum('total_amount');
    
    $lastYear = Sale::whereYear('created_at', now()->subYear()->year)
        ->sum('total_amount');
    
    return $lastYear > 0 ? round(($currentYear - $lastYear) / $lastYear * 100, 1) : 100;
}
    
}
