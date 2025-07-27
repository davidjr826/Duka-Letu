@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'New Sales')
@section('page_title', 'New Sales')

@section('content')
<section>
    <!-- Page title with back to sales button -->
    <div class='flex flex-row justify-between items-center mb-6'>
        <span class='text-lg font-medium'>New Sales</span>
        <a href="{{route('sales')}}" >
            <button class='w-fit px-3 py-1.5 border rounded-md flex flex-row justify-center items-center gap-x-2 text-gray-500 text-center cursor-pointer hover:bg-gray-100 transition-colors'>
                <i class="fas fa-arrow-left text-md"></i>
                Back to Sales
            </button>
        </a>
    </div>

    <!-- Sales Form -->
    <div class="bg-white rounded-lg shadow p-6">
        <form id="salesForm" action="#" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Sales Amount -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Sales Amount</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-500">$</span>
                        </div>
                        <input type="number" step="0.01" name="amount" id="amount" 
                            class="focus:outline-none block w-full pl-7 pr-12 py-2 border border-gray-300 rounded-md" 
                            placeholder="0.00" required>
                    </div>
                </div>

                <!-- Date -->
                <div>
                    <label for="date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                    <input type="date" name="date" id="date" 
                        class="focus:outline-none block w-full py-2 px-3 border border-gray-300 rounded-md" 
                        required>
                </div>
            </div>

            <!-- Additional Fields (can be expanded) -->
            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description (Optional)</label>
                <textarea name="description" id="description" rows="3" 
                    class="focus:outline-none block w-full py-2 px-3 border border-gray-300 rounded-md"></textarea>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4">
                <button type="reset" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors cursor-pointer">
                    Reset
                </button>
                <button type="submit" class="px-4 py-2 bg-black text-white rounded-md transition-colors cursor-pointer">
                    Save Sale
                </button>
            </div>
        </form>

        <!-- Sales Records Table -->
        <div class="mt-8">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Sales</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <!-- Sample Data Row -->
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                2023-06-15
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                $125.50
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                Widget sale
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-orange-500 hover:text-orange-700 mr-3">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <button class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Additional rows would go here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection