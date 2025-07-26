<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Sale;
use App\Models\SaleItem;

class salesController extends Controller // Changed to proper PascalCase
{
    public function sales(Request $request)
    {
        $user = auth()->user();
        
        // 1. Parse date inputs (default: last 30 days)
        $startDate = Carbon::parse($request->input('start_date', Carbon::today()->subDays(30)));
        $endDate = Carbon::parse($request->input('end_date', Carbon::today()));
        
        // 2. Query sales with eager loading
        $sales = Sale::with(['items.product' => function($query) {
                $query->withTrashed(); // Include deleted products
            }])
            ->whereBetween('created_at', [
                $startDate->startOfDay(), 
                $endDate->endOfDay()
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // 3. Calculate statistics with NULL handling
        $totalSales = Sale::whereBetween('created_at', [
                $startDate->startOfDay(), 
                $endDate->endOfDay()
            ])
            ->sum('total_amount') ?? 0;
            
        $totalProfit = SaleItem::whereHas('sale', function($query) use ($startDate, $endDate) {
                $query->whereBetween('created_at', [
                    $startDate->startOfDay(),
                    $endDate->endOfDay()
                ]);
            })
            ->selectRaw('
                SUM(
                    (sale_items.unit_price - COALESCE(products.cost_price, 0)) 
                    * sale_items.quantity
                ) as profit
            ')
            ->leftJoin('products', 'sale_items.product_id', '=', 'products.id')
            ->value('profit') ?? 0;
            
        $avgRevenue = Sale::whereBetween('created_at', [
                $startDate->startOfDay(), 
                $endDate->endOfDay()
            ])
            ->avg('total_amount') ?? 0;

        // 4. Return view with formatted data
        return view('admin.sales', [
            'user' => $user,
            'sales' => $sales,
            'totalSales' => $totalSales, // Removed number_format here since you're doing it in the view
            'totalProfit' => $totalProfit, // Removed number_format here
            'avgRevenue' => $avgRevenue, // Removed number_format here
            'startDate' => $startDate,
            'endDate' => $endDate,
            'profitMargin' => $totalSales > 0 
                ? ($totalProfit / $totalSales) * 100 // Removed number_format here
                : 0
        ]);
    }

    public function new_sales()
    {
        $user = auth()->user();
        return view('admin.new_sales', compact('user'));
    }
}