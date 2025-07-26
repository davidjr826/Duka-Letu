@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'Dashboard')
@section('page_title', 'Products')

@section('content')
    <section>
        <div 
        x-data="{
            products: {{ Js::from($products->map(function($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'buying' => $product->buying,
                    'selling' => $product->selling,
                    'quantity' => $product->quantity,
                    'category' => $product->category ? $product->category->name : 'No Category'
                ];
            })) }},
            getProfit(item) {
                return item.selling - item.buying;
            },
            getTotal(item) {
                return this.getProfit(item) * item.quantity;
            }
        }"
        class="bg-white p-4 rounded shadow-xl drop-shadow-sm mt-4 py-6"
        >
            <!-- Debug output (remove after testing) -->
            <div x-text="'Total products: ' + products.length" class="hidden"></div>
            
            <div class="flex flex-row justify-between items-center mb-6">
                <div class="flex justify-between items-center">
                    <p class="font-medium text-xl text-start">List Of Products</p>
                </div>

                <!-- Add Product Modal -->
                <div x-data="{ showModal: false }">
                    <button @click="showModal = true" class="flex items-center gap-2 border border-gray-400 px-4 py-2 rounded transition cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        <span class="uppercase text-xs">Add Product</span>
                    </button>

                    <!-- Modal -->
                        <div x-show="showModal" class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-80">
                        <div @click.outside="showModal = false" class="bg-white px-4 py-6 rounded-lg w-full max-w-sm max-h-[90vh] overflow-y-auto shadow-lg">

                            <h2 class="text-lg font-semibold mb-4">Add New Product</h2>
                            <form action="{{ route('products.store') }}" method="POST" class="flex flex-col gap-4">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                                    <input type="text" name="name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                    <select name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Buying Price</label>
                                    <input type="number" name="cost_price" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Selling Price</label>
                                    <input type="number" name="price" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black" required>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                    <input type="number" name="quantity" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-black" required>
                                </div>

                                <div class="flex justify-end gap-2 pt-4">
                                    <button type="button" @click="showModal = false" class="px-4 py-2 text-sm bg-gray-200 rounded hover:bg-gray-300 transition">Cancel</button>
                                    <button type="submit" class="px-4 py-2 text-sm bg-black text-white rounded hover:bg-gray-800 transition">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full border text-xs text-left">
                    <thead class="bg-gray-200 text-gray-700 uppercase">
                        <tr>
                            <th class="px-3 py-4 text-center border border-gray-400">s/n</th>
                            <th class="px-3 py-4 text-center border border-gray-400">Product Name</th>
                            <th class="px-3 py-4 text-center border border-gray-400">Category</th>
                            <th class="px-3 py-4 text-center border border-gray-400">Buying Price</th>
                            <th class="px-3 py-4 text-center border border-gray-400">Selling Price</th>
                            <th class="px-3 py-4 text-center border border-gray-400">Profit</th>
                            <th class="px-3 py-4 text-center border border-gray-400">Quantity</th>
                            <th class="px-3 py-4 text-center border border-gray-400">Total Profit</th>
                           
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        <template x-if="products.length === 0">
                            <tr>
                                <td colspan="8" class="px-3 py-4 text-center border text-red-500">
                                    No products found
                                </td>
                            </tr>
                        </template>
                        
                        <template x-for="(item, index) in products" :key="item.id">
                            <tr>
                                <td class="px-3 py-4 text-center border border-gray-400" x-text="index + 1"></td>
                                <td class="px-3 py-4 text-center border border-gray-400" x-text="item.name"></td>
                                <td class="px-3 py-4 text-center border border-gray-400" x-text="item.category"></td>
                                <td class="px-3 py-4 text-center border border-gray-400" x-text="Number(item.buying).toLocaleString()"></td>
                                <td class="px-3 py-4 text-center border border-gray-400" x-text="Number(item.selling).toLocaleString()"></td>
                                <td class="px-3 py-4 text-center border border-gray-400" x-text="getProfit(item).toLocaleString()"></td>
                                <td class="px-3 py-4 text-center border border-gray-400" x-text="item.quantity"></td>
                                <td class="px-3 py-4 text-center border border-gray-400" x-text="getTotal(item).toLocaleString()"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Alpine.js for modal toggle -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endsection