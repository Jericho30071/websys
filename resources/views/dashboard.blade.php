<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="text-gray-500 dark:text-gray-400 text-sm">Total Items</div>
                    <div class="text-2xl font-bold text-gray-800 dark:text-gray-100">{{ $totalItems ?? 0 }}</div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="text-gray-500 dark:text-gray-400 text-sm">In Stock</div>
                    <div class="text-2xl font-bold text-green-600">{{ $inStock ?? 0 }}</div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="text-gray-500 dark:text-gray-400 text-sm">Out of Stock</div>
                    <div class="text-2xl font-bold text-red-600">{{ $outOfStock ?? 0 }}</div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm rounded-lg p-4">
                    <div class="text-gray-500 dark:text-gray-400 text-sm">Recently Deleted</div>
                    <div class="text-2xl font-bold text-yellow-500">{{ $deletedItems ?? 0 }}</div>
                </div>
            </div>

            {{-- Recent Items Table --}}
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Recent Items</h3>
                    <a href="{{ route('items.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        + Add Item
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-gray-500 dark:text-gray-300">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Category</th>
                                <th class="px-4 py-2 text-left">Stock</th>
                                <th class="px-4 py-2 text-left">Added On</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800">
                            @forelse($recentItems ?? [] as $item)
                                <tr class="border-b dark:border-gray-700">
                                    <td class="px-4 py-2">{{ $item->name }}</td>
                                    <td class="px-4 py-2">{{ $item->category }}</td>
                                    <td class="px-4 py-2">{{ $item->stock }}</td>
                                    <td class="px-4 py-2">{{ $item->created_at->format('M d, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center px-4 py-4 text-gray-400">No recent items.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
