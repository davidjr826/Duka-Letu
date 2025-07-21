@extends('layouts.app')
@extends('layouts.preloader')

@section('title', 'History')
@section('page_title', 'History')

@section('content')
    <section>
        <div class='flex flex-row justify-between items-center'>
            <span class='text-lg font-medium'>History</span>
            <a href="{{route('inventory')}}" >
                <button class='w-fit px-3 py-1.5 border rounded-md flex flex-row justify-center items-center gap-x-2 text-gray-500 text-center cursor-pointer'>
                    <i class="fas fa-arrow-left text-md"></i>
                    Back To Inventory
                </button>
            </a>
        </div>
    </section>
@endsection