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
                <a href="{{route('history')}}" >
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
                <span class='text-md font-semibold text-gray-900'>All Products</span>
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
                <div class='text-lg font-medium w-1/2'><span class='w-full'>Inventory List</span></div>

                <!-- Search input -->
                <div class='w-full flex justify-center items-center'>
                    <input
                        id="searchInput"
                        type="text"
                        placeholder="Search product..."
                        class="border rounded-l-md focus:outline-none px-3 py-2 w-full"
                        onkeyup="searchTable()"
                    />
                    <i class="fas fa-search text-md border rounded-r-md p-3 cursor-pointer"></i>
                </div>

                <div class='flex justify-end w-1/2'>
                    <span class='bg-gray-500 text-white w-fit px-3 py-0.5 text-sm font-medium'>129 products</span>
                </div>
            </div>

            @php
                $items = [
                    ['id' => 1, 'Category' => 'Pepsi', 'Current_stock' => 0, 'buying_price' => 1200, 'quantity' => 50],
                    ['id' => 2, 'Category' => 'Kiwi', 'Current_stock' => 0, 'buying_price' => 800, 'quantity' => 40],
                    ['id' => 3, 'Category' => 'Biscuits', 'Current_stock' => 0, 'buying_price' => 500, 'quantity' => 100],
                    ['id' => 4, 'Category' => 'Pipi', 'Current_stock' => 0, 'buying_price' => 300, 'quantity' => 200],
                    ['id' => 5, 'Category' => 'Maji', 'Current_stock' => 0, 'buying_price' => 600, 'quantity' => 80],
                    ['id' => 6, 'Category' => 'Karamu', 'Current_stock' => 0, 'buying_price' => 700, 'quantity' => 60],
                    ['id' => 7, 'Category' => 'Penseli', 'Current_stock' => 0, 'buying_price' => 250, 'quantity' => 120],
                    ['id' => 8, 'Category' => 'Daftari', 'Current_stock' => 0, 'buying_price' => 1000, 'quantity' => 70],
                    ['id' => 9, 'Category' => 'Wembe', 'Current_stock' => 0, 'buying_price' => 200, 'quantity' => 150],
                    ['id' => 10, 'Category' => 'Coca Cola', 'Current_stock' => 0, 'buying_price' => 1300, 'quantity' => 90],
                    ['id' => 11, 'Category' => 'Mango Juice', 'Current_stock' => 0, 'buying_price' => 1500, 'quantity' => 45],
                    ['id' => 12, 'Category' => 'Sabuni', 'Current_stock' => 0, 'buying_price' => 400, 'quantity' => 110],
                ];
            @endphp

            <div class="pt-6 px-4">
                <div class="shadow-md rounded-lg border border-gray-200">
                    <div class="overflow-y-auto max-h-[440px]">
                        <table class="min-w-full bg-white mb-6">
                            <thead class="bg-gray-100 text-gray-700 uppercase text-sm sticky top-0 z-10">
                                <tr>
                                    <th class="py-5 px-3 text-center border-b bg-gray-100">ID</th>
                                    <th class="py-5 px-10 text-start border-b bg-gray-100">Category</th>
                                    <th class="py-5 px-10 text-start border-b bg-gray-100">Current Stock</th>
                                    <th class="py-5 px-3 text-center border-b bg-gray-100">Buying Price</th>
                                    <th class="py-5 px-3 text-center border-b bg-gray-100">Quantity</th>
                                </tr>
                            </thead>
                            <tbody id="inventoryTable" class="text-gray-600 text-sm">
                                @foreach($items as $item)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="py-4 px-6 text-center">{{ $item['id'] }}</td>
                                        <td class="py-4 px-10 text-start">{{ $item['Category'] }}</td>
                                        <td class="py-4 px-10 text-start">{{ $item['Current_stock'] }}</td>
                                        <td class="py-4 px-6 text-center">{{ number_format($item['buying_price']) }}</td>
                                        <td class="py-4 px-6 text-center">{{ $item['quantity'] }}</td>
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

        <!-- Search Script -->
        <script>
            function searchTable() {
                const input = document.getElementById("searchInput").value.toLowerCase();
                const rows = document.querySelectorAll("#inventoryTable tr:not(#noResultRow)");
                const noResultRow = document.getElementById("noResultRow");
                let found = false;

                rows.forEach(row => {
                    const nameCell = row.children[1]; // Name column
                    if (nameCell && nameCell.textContent.toLowerCase().includes(input)) {
                        row.style.display = "";
                        found = true;
                    } else {
                        row.style.display = "none";
                    }
                });

                noResultRow.classList.toggle("hidden", found);
            }
        </script>

    </section>
@endsection