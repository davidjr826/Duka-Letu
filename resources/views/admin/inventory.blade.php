@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'inventory')
@section('page_title', 'Inventory Management')

@section('content')
    <section class='pt-3'>

        <!-- links buttons -->
        <div class='flex flex-row justify-between items-center'>
            <div>
                <a href="{{route('products')}}" >
                    <button class='w-fit px-3 py-1.5 border rounded-md flex flex-row justify-center items-center gap-x-2 text-gray-500 text-center cursor-pointer'>
                        <i class="fas fa-arrow-left text-md"></i>
                        Back to Products
                    </button>
                </a>
            </div>

            <div class='flex flex-row justify-center items-center gap-x-3'>
                <a href="#" >
                    <button class='w-fit px-3 py-1.5 border rounded-md text-gray-500 text-center cursor-pointer'>
                        History
                    </button>
                </a>
                <a href="#" >
                    <button class='w-fit px-3 py-1.5 border rounded-md flex flex-row justify-center items-center gap-x-2 text-gray-500 text-center cursor-pointer'>
                        <i class="fas fa-arrow-top text-md"></i>
                        Bulk Update
                    </button>
                </a>
            </div>
        </div> 

        <!-- info cards -->
        <div class='grid grid-cols-4 justify-between items-center gap-x-2 pt-6'>

            <!-- All Items card -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white flex flex-col justify-center items-center gap-y-0.5">
                <span class='text-md font-semibold text-gray-900'>All Items</span>
                <span class='text-xs font-semibold text-gray-500'>123 Products</span>
            </div>

            <!-- Low Stock card -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white flex flex-col justify-center items-center gap-y-0.5">
                <span class='text-md font-semibold text-gray-900'>Low Stock</span>
                <span class='text-xs font-semibold text-gray-500'>46 Products</span>
            </div>

            <!-- Out of Stock card -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white flex flex-col justify-center items-center gap-y-0.5">
                <span class='text-md font-semibold text-gray-900'>Out Of Stock</span>
                <span class='text-xs font-semibold text-gray-500'>16 Products</span>
            </div>

            <!-- Unrecognized card -->
            <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md px-6 py-5 bg-white flex flex-col justify-center items-center gap-y-0.5">
                <span class='text-md font-semibold text-gray-900'>Unrecognized</span>
                <span class='text-xs font-semibold text-gray-500'>32 Products</span>
            </div>

        </div>

        <!-- Search inventory and product list -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class='flex flex-col gap-y-4 rounded-md px-6 py-5 bg-white mt-12'>
            <div class="flex flex-row justify-between items-center gap-y-0.5 w-full">
                <div class='w-full'><span>Inventory List</span></div>
                <div class='w-full flex justify-center items-center'>
                    <input type="text" placeholder="Search sales..." class="border rounded-l-md focus:outline-none px-3 py-2 w-full" />
                    <i class="fas fa-search text-md border rounded-r-md p-3 cursor-pointer"></i>
                </div>
                <div class='w-full flex justify-end'><span class='bg-blue-600 rounded-md text-white w-fit px-3 py-0.5'>129 products</span></div>
            </div>

            @php
                $items = [
                    ['id' => 1, 'name' => 'Pepsi'],
                    ['id' => 2, 'name' => 'Kiwi'],
                    ['id' => 3, 'name' => 'Biscuits'],
                    ['id' => 4, 'name' => 'Pipi'],
                    ['id' => 5, 'name' => 'Maji'],
                    ['id' => 6, 'name' => 'Karamu'],
                    ['id' => 7, 'name' => 'Penseli'],
                    ['id' => 8, 'name' => 'Daftari'],
                    ['id' => 9, 'name' => 'Wembe'],
                    ['id' => 10, 'name' => 'Coca Cola'],
                    ['id' => 11, 'name' => 'Mango Juice'],
                    ['id' => 12, 'name' => 'Sabuni']
                ];
            @endphp

            <div class="pt-6 px-4">
                <div class="overflow-x-auto shadow-md rounded-lg">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead class="bg-gray-100 text-gray-700 uppercase text-sm leading-normal">
                            <tr>
                                <th class="py-3 px-6 text-left border-b">ID</th>
                                <th class="py-3 px-6 text-left border-b">Product Name</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @foreach($items as $item)
                                <tr class="border-b hover:bg-gray-50 transition duration-300">
                                    <td class="py-3 px-6 border-r">{{ $item['id'] }}</td>
                                    <td class="py-3 px-6">{{ $item['name'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>


        </div>

    </section>
@endsection