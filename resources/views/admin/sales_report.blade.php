@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'Sales Report')
@section('page_title', 'Sales Report')

@section('content')
    <section>
        <!-- links buttons -->
        <div class='flex flex-row justify-end items-center'>

            <div class='flex flex-row justify-center items-center gap-x-3'>
                <a href="{{ route('sales') }}" >
                    <button class='w-fit px-3 py-1.5 border rounded-md text-gray-500 text-center cursor-pointer'>
                        <i class="fas fa-arrow-left text-md"></i>
                        Back To Sales
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
        <div class="flex justify-between items-start w-full p-4 rounded-md flex-col md:flex-row">
            <!-- Filter Section -->
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
        </div>

        <!-- info cards -->
        <div class='grid grid-cols-4 justify-between items-center gap-x-2 mt-12'>

            <!-- card one -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-col justify-center items-center'>
                    <span class='font-semibold'>Total Products</span>
                    <span class='text-gray-500 text-xl font-semibold'>8543</span>
                </div>
            </div>

            <!-- card two -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-col justify-center items-center'>
                    <span class='font-semibold'>Total Sales</span>
                    <span class='text-gray-500 text-xl font-semibold'>Tsh 0.000</span>
                </div>
            </div>

            <!-- card three -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-col justify-center items-center'>
                    <span class='font-semibold'>Total Profit</span>
                    <span class='text-green-500 text-xl font-semibold'>Tsh 0.000</span>
                </div>
            </div>

            <!-- card four -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-col justify-center items-center'>
                    <span class='font-semibold'>Total Sales</span>
                    <span class='text-gray-500 text-xl font-semibold'>Tsh 123,900</span>
                </div>
            </div>
        </div>

        <!-- sales records -->
        <div class='flex flex-row justify-between items-center gap-x-5 w-full'>
            <!-- daily sales summary -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md p-6 bg-white w-3/4 mt-12">
                <div class='grid grid-cols-2 justify-between items-center w-full'>
                    <div class='w-full font-medium'>
                        <span>Sales Records</span>
                    </div>
                    <div class='w-full flex justify-end items-center'>
                        <input type="text" placeholder="Search sales..." class="border rounded-l-md focus:outline-none px-3 py-2 w-4/6" />
                        <i class="fas fa-search text-md text-gray-800 border rounded-r-md p-3 cursor-pointer"></i>
                    </div>
                </div>

                <div class='border border-gray-300 mt-3 p-0'></div>

                <!-- No sales found -->
                <div class='py-20'>
                    <div class='flex justify-center items-center'>
                        <img src='/images/cart.png' alt='no_sales' class='size-16' />
                    </div>
                    <div class='flex flex-col justify-center items-center gap-y-1 pt-3'>
                        <span class='text-xl font-medium'>No Sales Data</span>
                        <span class='text-xs text-gray-600'>No sales records match your filter criteria</span>
                    </div>
                </div>
            </div>

            <!-- Top salling products -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md p-6 bg-white w-1/2 mt-8">
                <div class='w-full font-medium'>
                    <span>Top Selling Products</span>
                </div>

                <div class='border border-gray-300 mt-3 p-0'></div>

                <!-- No sales found -->
                <div class='py-20'>
                    <div class='flex justify-center items-center'>
                        <img src='/images/sellingData.png' alt='no_sales' class='size-16' />
                    </div>
                    <div class='flex flex-col justify-center items-center gap-y-1 pt-3'>
                        <span class='text-xl font-medium'>No Product Data</span>
                        <span class='text-xs text-gray-600'>No sales records match your filter criteria</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sells Trend -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md p-6 bg-white w-full mt-12 min-h-[45vh]">
            <div class='w-full font-medium'>
                <span>Sales Trend</span>
            </div>
            <div class='border border-gray-300 mt-3 p-0'></div>
        </div>
    </section>
@endsection