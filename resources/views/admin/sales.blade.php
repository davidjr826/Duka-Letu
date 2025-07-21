@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'Sales')
@section('page_title', 'Sales')

@section('content')
    <section class='pt-3 w-full'>

        <!-- Filter and Add New Sales -->
        <div class="flex justify-between items-start w-full p-4 rounded-md flex-col md:flex-row">
            <!-- Filter Section -->
            <div>
                <span class="block mb-2 text-lg font-medium">Filter By</span>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                    <div class="flex flex-col">
                        <label for="start_date" class="mb-1 text-sm font-medium">Start Date</label>
                        <input type="date" id="start_date" name="start_date" class="h-10 px-3 rounded-md focus:outline-none border-2 border-gray-400 w-full" />
                    </div>

                    <div class="flex flex-col">
                        <label for="end_date" class="mb-1 text-sm font-medium">End Date</label>
                        <input type="date" id="end_date" name="end_date" class="h-10 px-3 rounded-md focus:outline-none border-2 border-gray-400 w-full" />
                    </div>

                    <div class="flex items-end">
                        <button class="w-fit px-6 h-10 rounded-md bg-black text-white uppercase text-xs cursor-pointer">Filter</button>
                    </div>
                </div>
            </div>

            <!-- Add New Sales Button -->
            <div class="mt-4 md:mt-14">
                <a href="{{route('new_sales')}}" >
                    <button class="flex items-center gap-2 px-4 h-10 rounded-md bg-black text-white uppercase text-xs cursor-pointer">
                        <i class="fas fa-plus"></i>
                        New Sale
                    </button>
                </a>
            </div>
        </div>

        <!-- cards -->
        <div class='grid grid-cols-3 justify-between items-center gap-x-2 mt-12'>

            <!-- card one -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-row justify-between'>
                    <span class='text-lg font-semibold text-gray-500'>Sales</span>
                    <span class='text-xs text-gray-500'>17 July - 17 June</span>
                </div>

                <div class='flex flex-col items-start pt-8'>
                    <span class='text-xl font-semibold'>Tsh 234,000</span>
                    <span class='text-gray-500'><span class='text-green-700 text-sm font-bold'>+55%</span> since last month</span>
                </div>
            </div>

            <!-- card two -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">
                <div class='flex flex-row justify-between'>
                    <span class='text-lg font-semibold text-gray-500'>Total Profit</span>
                    <span class='text-xs text-gray-500'>17 July - 17 June</span>
                </div>

                <div class='flex flex-col items-start pt-8'>
                    <span class='text-xl font-semibold'>3.200</span>
                    <span class='text-gray-500'><span class='text-green-600 text-sm font-bold'>+12%</span> since last month</span>
                </div>
            </div>

            <!-- card three -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white">

                <div class='flex flex-row justify-between'>
                    <span class='text-lg font-semibold text-gray-500'>Avg. Revenue</span>
                    <span class='text-xs text-gray-500'>17 July - 17 June</span>
                </div>

                <div class='flex flex-col items-start pt-8'>
                    <span class='text-xl font-semibold'>Tsh 1.200</span>
                    <span class='text-gray-500'><span class='text-gray-500 text-sm font-bold'>+213%</span> since last month</span>
                </div>
            </div>
        </div>

        <!-- sales records -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md p-6 bg-white w-full mt-12">
            <div class='grid grid-cols-2 justify-between items-center w-full'>
                <div class='w-full font-medium'>
                    <span>Sales Records</span>
                </div>
                <div class='w-full flex justify-end items-center'>
                    <input type="text" placeholder="Search sales..." class="border border-gray-400 rounded-l-md focus:outline-none px-3 py-2 w-4/6" />
                    <i class="fas fa-search text-md text-gray-800 border border-gray-400 rounded-r-md p-3 cursor-pointer"></i>
                </div>
            </div>

            <div class='border border-gray-300 mt-3 p-0'></div>

            <!-- No sales found -->
            <div class='py-20'>
                <div class='flex justify-center items-center'>
                    <img src='/images/cart.png' alt='no_sales' class='size-16' />
                </div>
                <div class='flex flex-col justify-center items-center gap-y-1 pt-3'>
                    <span class='text-xl font-medium'>No Sales Found</span>
                    <span class='text-xs text-gray-600'>No sales records match your filter criteria</span>
                    <a href="{{route('new_sales')}}" >
                        <button class="w-fit px-3 py-2 bg-black text-white rounded-md mt-3 cursor-pointer flex justify-center items-center gap-x-3 
                            hover:text-black hover:bg-white hover:border-2 hover:border-black transition-all ease-in-out duration-500">
                            <i class="fas fa-shopping-cart text-md"></i>
                            Create New Sales
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection