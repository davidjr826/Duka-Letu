@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'Sales')
@section('page_title', 'Sales')

@section('content')
    <section class='pt-3 w-full'>
        <!-- Filter and Add New Sales -->
        <form method="GET" action="{{ route('sales') }}" class="flex justify-between items-start w-full p-4 rounded-md flex-col md:flex-row">
            <!-- Filter Section -->
            <div>
                <span class="block mb-2 text-lg font-medium">Filter By</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="flex flex-col">
                        <label for="start_date" class="mb-1 text-sm">Start Date</label>
                        <input type="date" id="start_date" name="start_date" 
                            value="{{ old('start_date', $startDate->format('Y-m-d')) }}"
                            class="h-10 px-3 rounded-md focus:outline-none border-2 border-black w-full" />
                    </div>

                    <div class="flex flex-col">
                        <label for="end_date" class="mb-1 text-sm">End Date</label>
                        <input type="date" id="end_date" name="end_date" 
                            value="{{ old('end_date', $endDate->format('Y-m-d')) }}"
                            class="h-10 px-3 rounded-md focus:outline-none border-2 border-black w-full" />
                    </div>

                    <div class="flex items-end">
                        <button type="submit" class="w-fit px-6 h-10 rounded-md bg-black text-white uppercase text-xs cursor-pointer">
                            Filter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Add New Sales Button -->
            <div class="mt-4 md:mt-14">
                <a href="{{ route('new_sales') }}">
                    <button type="button" class="flex items-center gap-2 px-4 h-10 rounded-md bg-black text-white uppercase text-xs cursor-pointer">
                        <i class="fas fa-plus"></i>
                        New Sale
                    </button>
                </a>
            </div>
        </form>

        <!-- cards -->
        <div class='grid grid-cols-1 md:grid-cols-3 justify-between items-center gap-4 mt-12'>
            <!-- card one -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-row justify-between'>
                    <span class='text-lg font-semibold text-gray-500'>Sales</span>
                    <span class='text-xs text-gray-500'>{{ $startDate->format('d M') }} - {{ $endDate->format('d M Y') }}</span>
                </div>

                <div class='flex flex-col items-start pt-8'>
                    {{-- <span class='text-xl font-semibold'>Tsh {{ number_format($totalSales) }}</span> --}}
                    <span class="text-xl font-semibold">Tsh {{ number_format($totalSales, 0) }}</span>
                    <span class='text-gray-500'>
                        <span class='text-green-700 text-sm font-bold'>+{{ rand(5, 55) }}%</span> since last month
                    </span>
                </div>
            </div>

            <!-- card two -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-row justify-between'>
                    <span class='text-lg font-semibold text-gray-500'>Total Profit</span>
                    <span class='text-xs text-gray-500'>{{ $startDate->format('d M') }} - {{ $endDate->format('d M Y') }}</span>
                </div>

                <div class='flex flex-col items-start pt-8'>
                    <span class='text-xl font-semibold'>Tsh {{ number_format($totalProfit) }}</span>
                    <span class='text-gray-500'>
                        <span class='text-green-600 text-sm font-bold'>+{{ rand(5, 20) }}%</span> since last month
                    </span>
                </div>
            </div>

            <!-- card three -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-row justify-between'>
                    <span class='text-lg font-semibold text-gray-500'>Avg. Revenue</span>
                    <span class='text-xs text-gray-500'>{{ $startDate->format('d M') }} - {{ $endDate->format('d M Y') }}</span>
                </div>

                <div class='flex flex-col items-start pt-8'>
                    <span class='text-xl font-semibold'>Tsh {{ number_format($avgRevenue) }}</span>
                    <span class='text-gray-500'>
                        <span class='text-gray-500 text-sm font-bold'>+{{ rand(10, 50) }}%</span> since last month
                    </span>
                </div>
            </div>
        </div>

        <!-- sales records -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md p-6 bg-white w-full mt-12">
            <div class='grid grid-cols-1 md:grid-cols-2 justify-between items-center w-full gap-4'>
                <div class='w-full font-medium'>
                    <span>Sales Records</span>
                </div>
                <div class='w-full flex justify-end items-center'>
                    <input type="text" placeholder="Search sales..." class="border rounded-l-md focus:outline-none px-3 py-2 w-full md:w-4/6" />
                    <button class="fas fa-search text-md text-gray-800 border rounded-r-md p-3 cursor-pointer"></button>
                </div>
            </div>

            <div class='border border-gray-300 mt-3 p-0'></div>

            @if($sales->count() > 0)
                <!-- Sales Table -->
                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice #</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Items</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Profit</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($sales as $sale)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $sale->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $sale->invoice_number }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $sale->items->count() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    Tsh {{ number_format($sale->total_amount) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @php
                                        $profit = $sale->items->sum(function($item) {
                                            return ($item->price - $item->product->cost_price) * $item->quantity;
                                        });
                                    @endphp
                                    Tsh {{ number_format($profit) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $sales->links() }}
                </div>
            @else
                <!-- No sales found -->
                <div class='py-20'>
                    <div class='flex justify-center items-center'>
                        <img src='/images/cart.png' alt='no_sales' class='size-16' />
                    </div>
                    <div class='flex flex-col justify-center items-center gap-y-1 pt-3'>
                        <span class='text-xl font-medium'>No Sales Found</span>
                        <span class='text-xs text-gray-600'>No sales records match your filter criteria</span>
                        <a href="{{ route('new_sales') }}">
                            <button class="w-fit px-3 py-2 bg-black text-white rounded-md mt-3 cursor-pointer flex justify-center items-center gap-x-3 
                                hover:text-black hover:bg-white hover:border-2 hover:border-black transition-all ease-in-out duration-500">
                                <i class="fas fa-shopping-cart text-md"></i>
                                Create New Sales
                            </button>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection