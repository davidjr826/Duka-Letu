@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <section>
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
        class="bg-white p-4 rounded shadow-xl drop-shadow-sm mt-4 py-6"
        >
            <!-- Filters -->
            <div class="flex justify-between items-center mb-4">
                <p class="font-medium text-xl text-start">List Of Products</p>
            </div>

            <div class="flex justify-between items-center mb-4">
                <!-- Left Section: Title and Sort Selection -->
                <div class="flex items-center gap-4">
                    <h2 class="text-xs uppercase font-semibold">Sort By</h2>

                    <select class="border w-fit rounded px-5 py-2 focus:outline-none uppercase text-xs">
                        <option value="name">Name</option>
                        <option value="price">Price</option>
                    </select>
                </div>

                <!-- Right Section: Add Button -->
                <button class="flex items-center gap-2 border border-black px-4 py-2 rounded transition cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span class="uppercase text-xs">Add Product</span>
                </button>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border text-xs text-left">
                    <thead class="bg-gray-200 text-gray-700 uppercase">
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
                        <template x-for="item in products" :key="item.id">
                        <tr>
                            <td class="px-3 py-4 text-center border" x-text="item.id"></td>
                            <td class="px-3 py-4 text-center border" x-text="item.name"></td>
                            <td class="px-3 py-4 text-center border" x-text="item.buying.toLocaleString()"></td>
                            <td class="px-3 py-4 text-center border" x-text="item.selling.toLocaleString()"></td>
                            <td class="px-3 py-4 text-center border" x-text="getProfit(item).toLocaleString()"></td>
                            <td class="px-3 py-4 text-center border" x-text="getTotal(item).toLocaleString()"></td>
                        </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection