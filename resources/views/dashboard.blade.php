<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-w-7xl mx-auto px-6">
        @foreach ($products as $product)
            <div class="max-w-sm rounded overflow-hidden shadow-lg bg-white">
                <img class="w-full h-48 object-cover" src="{{ $product->image }}" alt="{{ $product->name }}">
                <div class="px-6 py-4">
                    <div class="font-bold text-xl mb-2">{{ $product->name }}</div>
                    <p class="text-gray-700 text-base">{{ $product->description }}</p>
                    <p class="mt-2 font-semibold text-lg text-green-600">Rs. {{ $product->price }}</p>
                </div>
                <div class="px-6 pt-4 pb-2">
                    <a href="{{ route('cart.add', $product->id) }}"
                        onclick="event.preventDefault(); document.getElementById('buy-form-{{ $product->id }}').submit();"
                        class="block w-full text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded-lg text-lg transition duration-300">
                        Buy
                    </a>

                    <form id="buy-form-{{ $product->id }}" action="{{ route('cart.add', $product->id) }}"
                        method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
