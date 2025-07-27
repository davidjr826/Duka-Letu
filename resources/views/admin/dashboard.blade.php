<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

{{-- Cards --}}
    <section class='pt-10'>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4">
            @foreach([
                ['label' => 'all products', 'value' => $productCount, 'icon' => 'shopping-cart', 'color' => 'gray'],
                ['label' => 'total sales (TSH)', 'value' => number_format($salesSummary->total_sales ?? 0), 'icon' => 'chart-line', 'color' => 'gray'],
                ['label' => 'total loans (TSH)', 'value' => number_format($salesSummary->loans ?? 0), 'icon' => 'credit-card', 'color' => 'gray'],
                ['label' => 'total profit', 'value' => number_format($salesSummary->profit ?? 0), 'icon' => 'hand-holding-dollar', 'color' => $salesSummary->profit < 0 ? 'red' : 'green'],
        ] as $card)
                @php
                    $bgColor = "bg-{$card['color']}-200";
                    $bgColor = "bg-{$card['color']}-200";
                    $iconColor = "text-{$card['color']}-600";
                @endphp
                <div class="flex flex-col md:flex-row justify-between items-center bg-white rounded shadow-md border border-gray-400 px-6 py-8">
                    <div class="p-3 rounded-md {{ $bgColor }} border border-gray-400">
                        <i class="fas fa-{{ $card['icon'] }} text-3xl {{ $iconColor }}"></i>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <p class="text-sm text-gray-500 uppercase font-medium">{{ $card['label'] }}</p>
                        <p class="text-lg font-semibold text-center">{{ $card['value'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- simple visualization -->
        {{-- Charts --}}
        <div class='mt-10'>
            <h2 class='text-xl font-medium text-start'>Simple Visualization</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
                <div class="bg-white p-8 rounded shadow border border-gray-400">
                    <p class="font-semibold">Daily Sales</p>
                    <p class="text-sm text-gray-500">(10%) increase in today sales</p>
                    <canvas id="dailyChart" class="mt-4 h-40"></canvas>
                    <p class="text-sm text-gray-700 mt-4">🕒 Updated 10min ago</p>
                </div>

                <div class="bg-white p-8 rounded shadow border border-gray-400">
                    <p class="font-semibold">Monthly Sales</p>
                    <p class="text-sm text-gray-500">(10%) increase in today sales</p>
                    <canvas id="monthlyChart" class="mt-4 h-40"></canvas>
                    <p class="text-sm text-gray-700 mt-4">🕒 Updated 10min ago</p>
                </div>
            </div>
        </div>

        {{-- Top Sales Product Filter --}}
        <div 
        x-data="{
            products: [
            { id: 1, name: 'Soap', buying: 1000, selling: 1200 },
            { id: 2, name: 'Sugar', buying: 2300, selling: 2700 },
            { id: 3, name: 'Tea', buying: 1500, selling: 1900 },
            { id: 4, name: 'Milk', buying: 1200, selling: 1500 },
            { id: 5, name: 'Bread', buying: 800, selling: 1000 }
            ],
            getProfit(item) {
            return item.selling - item.buying;
            },
            getTotal(item) {
            return this.getProfit(item) * 10;
            }
        }"
        class="bg-white p-4 rounded shadow mt-16 border py-6"
        >
        <!-- Filters -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-4">
            <p class="font-medium text-xl text-start">Top Sales Products</p>

                <div class="relative w-[200px]">
                    <!-- Date Input -->
                    <input 
                    type="month" 
                    class="peer bg-white border border-gray-300 text-gray-700 text-sm rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-full pl-10 pr-4 py-2"
                    />
                    
                    <!-- Calendar Icon -->
                    <div class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M6 2a1 1 0 00-1 1v1H5a2 2 0 00-2 2v1h14V6a2 2 0 00-2-2h-.002V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zM3 9v7a2 2 0 002 2h10a2 2 0 002-2V9H3z" />
                    </svg>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border text-xs text-left">
                    <thead class="bg-gray-100 text-gray-700 uppercase">
                        <tr>
                        <th class="px-3 py-4 text-center border">ID</th>
                        <th class="px-3 py-4 text-center border">Name</th>
                        <th class="px-3 py-4 text-center border">Buying Price</th>
                        <th class="px-3 py-4 text-center border">Selling Price</th>
                        <th class="px-3 py-4 text-center border">Profit</th>
                        <th class="px-3 py-4 text-center border">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        @foreach($topSalesProducts as $index => $product)
                        <tr>
                            <td class="px-3 py-4 text-center border">{{ $index + 1 }}</td>
                            <td class="px-3 py-4 text-center border">{{ $product->product_name }}</td>
                            <td class="px-3 py-4 text-center border">{{ number_format($product->buying_price) }}</td>
                            <td class="px-3 py-4 text-center border">{{ number_format($product->selling_price) }}</td>
                            <td class="px-3 py-4 text-center border">{{ number_format($product->selling_price - $product->buying_price) }}</td>
                            <td class="px-3 py-4 text-center border">{{ number_format($product->total_sold ?? 0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Chart.js --}}
        <script>
            // Prepare daily sales data
            const dailyLabels = {!! json_encode($dailySales->pluck('day')) !!};
            const dailyData = {!! json_encode($dailySales->pluck('total')) !!};

            const dailyChart = new Chart(document.getElementById('dailyChart'), {
                type: 'bar',
                data: {
                    labels: dailyLabels,
                    datasets: [{ 
                        label: 'Sales', 
                        data: dailyData, 
                        backgroundColor: '#5A5A5AFF' 
                    }]
                },
                options: { 
                    plugins: { 
                        legend: { display: false } 
                    }, 
                    scales: { 
                        y: { beginAtZero: true } 
                    } 
                }
            });

            // Prepare monthly sales data
            const monthlyLabels = {!! json_encode($monthlySales->map(function($item) {
                return Carbon\Carbon::create()->month($item->month)->format('M');
            })) !!};
            const monthlyData = {!! json_encode($monthlySales->pluck('total')) !!};

            const monthlyChart = new Chart(document.getElementById('monthlyChart'), {
                type: 'line',
                data: {
                    labels: monthlyLabels,
                    datasets: [{ 
                        label: 'Sales', 
                        data: monthlyData, 
                        borderColor: '#5A5A5AFF', 
                        fill: false 
                    }]
                },
                options: { 
                    plugins: { 
                        legend: { display: false } 
                    }, 
                    scales: { 
                        y: { beginAtZero: true } 
                    } 
                }
            });
        </script>

        <script src="https://unpkg.com/lucide@latest"></script>
        <script>lucide.createIcons();</script>
    </section>
@endsection