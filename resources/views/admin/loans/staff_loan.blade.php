@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'Staff Loan')
@section('page_title', 'Staff Loan')

@section('content')
    <section class='pt-4'>
        <!-- Full Inventory Report -->
        <div style="box-shadow: 2px 2px 4px 4px rgba(0,0,0,0.1);" class="rounded-md p-6 bg-white w-full">
            <div class='w-full font-medium'>
                <span class='text-xl font-medium'>Staff Loan</span>
            </div>
            <div class='border border-gray-300 mt-3 p-0'></div>
            
            <div class='py-0'>
                @php
                    $items = [
                        ['s/n' => 1, 'first_name' => 'Paul', 'last_name' => 'Cavain', 'company_no' => 'C10',  'product_name' => 'Kiwi', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 2, 'first_name' => 'Isaya', 'last_name' => 'Kelvin', 'company_no' => 'C10',  'product_name' => 'Soksi', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Paid'],
                        ['s/n' => 3, 'first_name' => 'Jordan', 'last_name' => 'Ntwale', 'company_no' => 'C10',  'product_name' => 'pepsi', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 4, 'first_name' => 'Adija', 'last_name' => 'Kassim', 'company_no' => 'C10',  'product_name' => 'Tissue Paper', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 5, 'first_name' => 'Jenny', 'last_name' => 'Adam', 'company_no' => 'C10',  'product_name' => 'Pen', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 6, 'first_name' => 'Asia', 'last_name' => 'Juma', 'company_no' => 'C10',  'product_name' => 'Lazor blade', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Paid'],
                        ['s/n' => 7, 'first_name' => 'Annie', 'last_name' => 'Justine', 'company_no' => 'C10',  'product_name' => 'Pen', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Paid'],
                        ['s/n' => 8, 'first_name' => 'Pauline', 'last_name' => 'Brian', 'company_no' => 'C10',  'product_name' => 'Water', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 9, 'first_name' => 'Jaden', 'last_name' => 'Mussa', 'company_no' => 'C10',  'product_name' => 'Kiwi', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 10, 'first_name' => 'Starnley', 'last_name' => 'Fabian', 'company_no' => 'C10',  'product_name' => 'Kiwi', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Not Paid'],
                        ['s/n' => 11, 'first_name' => 'Dax', 'last_name' => 'David', 'company_no' => 'C10',  'product_name' => 'Kiwi', 'quantity' => 2, 'loan_date' => '20-07-2025', 'status' => 'Paid'],
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
                                        <th class="py-3 px-6 text-start border-b bg-gray-100">product name</th>
                                        <th class="py-3 px-6 text-center border-b bg-gray-100">quantity</th>
                                        <th class="py-3 px-10 text-start border-b bg-gray-100">loan date</th>
                                        <th class="py-3 px-10 text-start border-b bg-gray-100">status</th>
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
                                            <td class="py-1 px-10 text-start">{{ $item['product_name'] }}</td>
                                            <td class="py-1 px-10 text-start">{{ $item['quantity'] }}</td>
                                            <td class="py-1 px-10 text-start">{{ $item['loan_date'] }}</td>
                                            <td class="py-1 px-10 text-start">{{ $item['status'] }}</td>
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
@endsection