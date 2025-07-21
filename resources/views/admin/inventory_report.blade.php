@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'inventory')
@section('page_title', 'Inventory report')

@section('content')
        <section>
        <!-- links buttons -->
        <div class='flex flex-row justify-end items-center'>

            <div class='flex flex-row justify-center items-center gap-x-3'>
                <a href="{{ route('inventory') }}" >
                    <button class='w-fit px-3 py-1.5 border rounded-md text-gray-500 text-center cursor-pointer'>
                        <i class="fas fa-arrow-left text-md"></i>
                        Back To Inventory
                    </button>
                </a>
                <a href="#" >
                    <button class='w-fit px-3 py-1.5 border rounded-md flex flex-row justify-center items-center gap-x-2 text-gray-500 text-center cursor-pointer'>
                        <i class="fas fa-print text-md"></i>
                        Print Report
                    </button>
                </a>
            </div>
        </div>

        <!-- Filter and Add New Sales -->
        <!-- <div class="flex justify-between items-start w-full p-4 rounded-md flex-col md:flex-row">

            <div class='w-full'>
                <span class="block font-semibold mb-2">Filter By</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 w-full">

                    <div class="flex flex-col w-full">
                        <label for="start_date" class="mb-1 text-sm">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="h-10 px-3 rounded-md focus:outline-none border-2 border-black w-full" />
                    </div>

                    <div class="flex flex-col w-full">
                        <label for="end_date" class="mb-1 text-sm">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="h-10 px-3 rounded-md focus:outline-none border-2 border-black w-full" />
                    </div>

                    <div class="flex items-end">
                        <button class="w-fit px-6 h-10 rounded-md bg-black text-white uppercase text-xs cursor-pointer">Generate</button>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- info cards -->
        <div class='grid grid-cols-4 justify-between items-center gap-x-2 mt-12'>

            <!-- card one -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-col justify-center items-center'>
                    <span class='font-semibold'>Total Products</span>
                    <span class='text-gray-500 text-xl font-semibold mt-2'>8543</span>
                </div>
            </div>

            <!-- card two -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-col justify-center items-center'>
                    <span class='font-semibold'>Inventory Value</span>
                    <span class='text-gray-500 text-xl font-semibold mt-2'>Tsh 0.000</span>
                </div>
            </div>

            <!-- card three -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-col justify-center items-center'>
                    <span class='font-semibold text-yellow-500'>Low Stock</span>
                    <span class='text-xl font-semibold mt-2 text-gray-500'>0.000</span>
                </div>
            </div>

            <!-- card four -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-col justify-center items-center'>
                    <span class='font-semibold text-red-500'>Out of Stock</span>
                    <span class='text-xl font-semibold mt-2 text-gray-500'>123,900</span>
                </div>
            </div>
        </div>

        <!-- inventory status -->
        <div class='flex flex-row justify-between items-center gap-x-5 w-full mt-4'>
            <!-- Inventory Status -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md p-6 bg-white w-1/2 mt-12">
                <div class='w-full font-medium'>
                    <span>Inventory Status</span>
                </div>

                <div class='border border-gray-300 mt-3 p-0'></div>

                <!-- pie chart -->
                <div class="p-6 flex flex-col md:flex-row justify-between items-center w-full gap-x-32">
                    <!-- Donut Chart Canvas -->
                    <div class="w-full md:w-2/5">
                        <canvas id="stockDonutChart"></canvas>
                    </div>

                    <!-- Legend -->
                    <div class="flex flex-col justify-start items-start w-full md:w-1/2">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-3 rounded bg-green-500"></div>
                            <span>In Stock</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-3 rounded bg-yellow-400"></div>
                            <span>Low Stock</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-3 rounded bg-red-500"></div>
                            <span>Out of Stock</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fast Moving Products -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md p-6 bg-white w-1/2 mt-11">
                <div class='w-full font-medium'>
                    <span>Fast Moving Products (Last 30 days)</span>
                </div>

                <div class='border border-gray-300 mt-3 p-0'></div>

                <!-- Table -->
                <div class='py-0'>
                    @php
                        $items = [
                            ['s/n' => 1, 'product' => 'Pepsi', 'sold' => 0,  'in_stock' => 50],
                            ['s/n' => 2, 'product' => 'Kiwi', 'sold' => 0, 'in_stock' => 40],
                            ['s/n' => 3, 'product' => 'Biscuits', 'sold' => 0, 'in_stock' => 100],
                            ['s/n' => 4, 'product' => 'Pipi', 'sold' => 0, 'in_stock' => 200],
                            ['s/n' => 5, 'product' => 'Maji', 'sold' => 0, 'in_stock' => 80],
                            ['s/n' => 6, 'product' => 'Karamu', 'sold' => 0, 'in_stock' => 60],
                            ['s/n' => 7, 'product' => 'Penseli', 'sold' => 0, 'in_stock' => 120],
                            ['s/n' => 8, 'product' => 'Daftari', 'sold' => 0,  'in_stock' => 70],
                            ['s/n' => 9, 'product' => 'Wembe', 'sold' => 0, 'in_stock' => 150],
                            ['s/n' => 10, 'product' => 'Coca Cola', 'sold' => 0,  'in_stock' => 90],
                            ['s/n' => 11, 'product' => 'Mango Juice', 'sold' => 0,  'in_stock' => 45],
                            ['s/n' => 12, 'product' => 'Sabuni', 'sold' => 0, 'in_stock' => 110],
                        ];
                    @endphp

                    <div class="pt-3">
                        <div class="rounded-lg border border-gray-200">
                            <div class="overflow-y-auto max-h-[230px]">
                                <table class="min-w-full bg-white">
                                    <thead class="bg-gray-100 text-gray-700 uppercase text-xs sticky top-0 z-10">
                                        <tr>
                                            <th class="py-4 px-10 text-start border-b bg-gray-100">s/n</th>
                                            <th class="py-4 px-10 text-start border-b bg-gray-100">Product</th>
                                            <th class="py-4 px-10 text-start border-b bg-gray-100">sold</th>
                                            <th class="py-4 px-10 text-center border-b bg-gray-100">In Stock</th>
                                        </tr>
                                    </thead>
                                    <tbody id="inventoryTable" class="text-gray-600 text-sm">
                                        @foreach($items as $item)
                                            <tr class="border-b hover:bg-gray-50 transition">
                                                <td class="py-3 px-10 text-start">{{ $item['s/n'] }}</td>
                                                <td class="py-3 px-10 text-start">{{ $item['product'] }}</td>
                                                <td class="py-3 px-10 text-start">{{ $item['sold'] }}</td>
                                                <td class="py-3 px-10 text-center">{{ $item['in_stock'] }}</td>
                                            </tr>
                                        @endforeach
                                        <tr id="noResultRow" class="hidden pt-8">
                                            <td colspan="4" class="text-center text-xl font-semibold text-red-500 py-4">No such product!!</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Inventory Report -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md p-6 bg-white w-full mt-12">
            <div class='w-full font-medium'>
                <span>Full Inventory Report</span>
            </div>
            <div class='border border-gray-300 mt-3 p-0'></div>
            
            <div class='py-0'>
                @php
                    $items = [
                        ['product' => 'Pepsi', 'category' => 'Drinks', 'sold' => 0,  'in_stock' => 'Not tracked', 'status' => 'Not tracked'],
                        ['product' => 'Kiwi', 'category' => 'Drinks', 'sold' => 0, 'in_stock' => 'Not tracked', 'status' => 'Not tracked'],
                        ['product' => 'Biscuits', 'category' => 'Drinks', 'sold' => 0, 'in_stock' => 'Not tracked', 'status' => 'Not tracked'],
                        ['product' => 'Pipi', 'category' => 'Drinks', 'sold' => 0, 'in_stock' => 'Not tracked', 'status' => 'in stock'],
                        ['product' => 'Maji', 'category' => 'Drinks', 'sold' => 0, 'in_stock' => 'Not tracked', 'status' => 'Not tracked'],
                        ['product' => 'Karamu', 'category' => 'Drinks', 'sold' => 0, 'in_stock' => 52, 'status' => 'Not tracked'],
                        ['product' => 'Penseli', 'category' => 'Drinks', 'sold' => 0, 'in_stock' => 'Not tracked', 'status' => 'Not tracked'],
                        ['product' => 'Daftari', 'category' => 'Drinks', 'sold' => 0,  'in_stock' => 'Not tracked', 'status' => 'Not tracked'],
                        ['product' => 'Wembe', 'category' => 'Drinks', 'sold' => 0, 'in_stock' => 'Not tracked', 'status' => 'Not tracked'],
                        ['product' => 'Coca Cola', 'category' => 'Drinks', 'sold' => 0,  'in_stock' => 'Not tracked', 'status' => 'Not tracked'],
                        ['product' => 'Mango Juice', 'category' => 'Drinks', 'sold' => 0,  'in_stock' => 'Not tracked', 'status' => 'Not tracked'],
                        ['product' => 'Sabuni', 'category' => 'Drinks', 'sold' => 0, 'in_stock' => 110, 'status' => 'Not tracked'],
                    ];
                @endphp

                <div class="pt-3">
                    <div class="rounded-lg border border-gray-200">
                        <div class="overflow-y-auto max-h-[330px]">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-100 text-gray-700 uppercase text-xs sticky top-0 z-10">
                                    <tr>
                                        <th class="py-4 px-10 text-start border-b bg-gray-100">Product</th>
                                        <th class="py-4 px-10 text-start border-b bg-gray-100">Category</th>
                                        <th class="py-4 px-10 text-center border-b bg-gray-100">In Stock</th>
                                        <th class="py-4 px-10 text-start border-b bg-gray-100">sold</th>
                                        <th class="py-4 px-10 text-start border-b bg-gray-100">status</th>
                                    </tr>
                                </thead>
                                <tbody id="inventoryTable" class="text-gray-600 text-sm">
                                    @foreach($items as $item)
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="py-3 px-10 text-start">{{ $item['product'] }}</td>
                                            <td class="py-3 px-10 text-start">{{ $item['category'] }}</td>
                                            <td class="py-3 px-10 text-center">{{ $item['in_stock'] }}</td>
                                            <td class="py-3 px-10 text-start">{{ $item['sold'] }}</td>
                                            <td class="py-3 px-10 text-start">
                                                <span class="rounded-sm w-fit bg-gray-600 py-1 px-3 text-xs text-white">
                                                    {{ $item['status'] }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr id="noResultRow" class="hidden pt-8">
                                        <td colspan="4" class="text-center text-xl font-semibold text-red-500 py-4">No such product!!</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('stockDonutChart').getContext('2d');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['In Stock', 'Low Stock', 'Out of Stock'],
                datasets: [{
                    data: [{{ $inStock }}, {{ $lowStock }}, {{ $outOfStock }}],
                    backgroundColor: ['#22c55e', '#facc15', '#ef4444'],
                    borderWidth: 1,
                }]
            },
            options: {
                cutout: '50%',
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
@endsection