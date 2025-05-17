@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-start mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Item Details</h2>
                <div class="flex space-x-2">
                    <a href="{{ route('items.edit', $item->id) }}" class="text-yellow-600 hover:text-yellow-800">Edit</a>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-800 ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
            
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Name</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $item->name }}</p>
                </div>
                
                <div>
                    <h3 class="text-sm font-medium text-gray-500">Description</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $item->description ?? 'N/A' }}</p>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Quantity</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $item->quantity }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Price</h3>
                        <p class="mt-1 text-sm text-gray-900">${{ number_format($item->price, 2) }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Created At</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $item->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Updated At</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $item->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-6">
                <a href="{{ route('items.index') }}" class="text-blue-600 hover:text-blue-800">← Back to all items</a>
            </div>
        </div>
    </div>
</div>
@endsection