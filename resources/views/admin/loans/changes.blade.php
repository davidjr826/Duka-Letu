@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'Changes')
@section('page_title', 'Changes')

@section('content')
    <section class='pt-4'>

        <!-- Full Inventory Report -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md p-6 bg-white w-full">
            <div class='flex flex-row justify-between items-center w-full font-medium'>
                <div>
                    <span class='text-lg font-medium'>Recruits Changes</span>
                </div>

                <div class="flex flex-row justify-between items-cente gap-x-4 bg-gray-100 p-2.5">
                    <button class="text-xs font-medium w-fit py-2 px-3 text-gray-400 bg-gray-200 uppercase cursor-pointer">Recruits</button>
                    <button class="text-xs font-medium w-fit py-2 px-4 text-gray-400 uppercase cursor-pointer">staff</button>
                    <button class="text-xs font-medium w-fit py-2 px-3 text-gray-400 uppercase cursor-pointer">In Service</button>
                </div>
            </div>
            <div class='border border-gray-300 mt-3 p-0'></div>
            
            <div class='py-0'>
                @php
                    $items = [
                        ['s/n' => 1, 'first_name' => 'Paul', 'last_name' => 'Cavain', 'company_no' => 'C10',  'Amount' => 1200, 'changes_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 2, 'first_name' => 'Kelvin', 'last_name' => 'John', 'company_no' => 'A1',  'Amount' => 1200, 'changes_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 3, 'first_name' => 'Sebanduja', 'last_name' => 'Ismail', 'company_no' => 'C111',  'Amount' => 1200, 'changes_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 4, 'first_name' => 'Brian', 'last_name' => 'Clain', 'company_no' => 'D10',  'Amount' => 1200, 'changes_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 5, 'first_name' => 'Jackson', 'last_name' => 'Dunia', 'company_no' => 'B15',  'Amount' => 1200, 'changes_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 6, 'first_name' => 'Joseph', 'last_name' => 'Fabian', 'company_no' => 'B72',  'Amount' => 1200, 'changes_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 7, 'first_name' => 'Isaya', 'last_name' => 'Pesambili', 'company_no' => 'C19',  'Amount' => 1200, 'changes_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 8, 'first_name' => 'Cuthbert', 'last_name' => 'Francis', 'company_no' => 'C32',  'Amount' => 1200, 'changes_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 9, 'first_name' => 'Jackline', 'last_name' => 'Noah', 'company_no' => 'A10',  'Amount' => 1200, 'changes_date' => '20-07-2025', 'status' => 'Not Paid'],
                    ];
                @endphp

                <div class="pt-3">
                    <div class="rounded-lg border border-gray-200">
                        <div class="overflow-y-auto max-h-[470px]">
                            <table class="min-w-full bg-white">
                                <thead class="bg-gray-100 text-gray-700 uppercase text-xs sticky top-0 z-10">
                                    <tr>
                                        <th class="py-3 px-4 text-start border-b bg-gray-100">s/n</th>
                                        <th class="py-3 px-5 text-start border-b bg-gray-100">first_name</th>
                                        <th class="py-3 px-5 text-start border-b bg-gray-100">last_name</th>
                                        <th class="py-3 px-6 text-start border-b bg-gray-100">Company number</th>
                                        <th class="py-3 px-6 text-start border-b bg-gray-100">Amount</th>
                                        <th class="py-3 px-10 text-start border-b bg-gray-100">status</th>
                                        <th class="py-3 px-6 text-start border-b bg-gray-100">Changes date</th>
                                        <th class="py-3 px-10 text-start border-b bg-gray-100">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="inventoryTable" class="text-gray-600 text-sm">
                                    @foreach($items as $item)
                                        <tr class="border-b hover:bg-gray-50 transition">
                                            <td class="py-1 px-4 text-start">{{ $item['s/n'] }}</td>
                                            <td class="py-1 px-10 text-start">{{ $item['first_name'] }}</td>
                                            <td class="py-1 px-10 text-center">{{ $item['last_name'] }}</td>
                                            <td class="py-1 px-10 text-start">{{ $item['company_no'] }}</td>
                                            <td class="py-1 px-10 text-start">{{ $item['Amount'] }}</td>
                                            <td class="py-1 px-10 text-start">{{ $item['status'] }}</td>
                                            <td class="py-1 px-10 text-start">{{ $item['changes_date'] }}</td>
                                            <td class="px-1 py-2 flex gap-2">
                                                <button
                                                    @click="#"
                                                    class="w-fit px-3 h-8 bg-gray-500 text-white text-xs rounded hover:bg-blue-600 uppercase flex items-center gap-2.5 cursor-pointer"
                                                >
                                                    <i class="fas fa-edit text-white text-sm"></i>
                                                </button>

                                                <button
                                                    @click="#"
                                                    class="w-fit px-3 h-8 bg-red-500 text-white text-xs rounded hover:bg-red-600 uppercase flex items-center gap-2.5 cursor-pointer"
                                                >
                                                    <i class="fas fa-trash text-white text-sm"></i>
                                                </button>
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
@endsection