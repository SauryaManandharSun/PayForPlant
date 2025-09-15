<x-app-layout>
    <div class="max-w-4xl mx-auto mt-6 bg-white shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Your Cart</h1>

        @if (count($cart) > 0)
            <table class="w-full border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">Product</th>
                        <th class="p-2 border">Unit Price</th>
                        <th class="p-2 border">Quantity</th>
                        <th class="p-2 border">Total Price</th>
                        <th class="p-2 border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $grandTotal = 0;
                    @endphp

                    @foreach ($cart as $id => $item)
                        @php
                            $totalPrice = $item['price'] * $item['quantity'];
                            $grandTotal += $totalPrice;
                        @endphp
                        <tr>
                            <td class="p-2 border">{{ $item['name'] }}</td>
                            <td class="p-2 border">${{ number_format($item['price'], 2) }}</td>
                            <td class="p-2 border">{{ $item['quantity'] }}</td>
                            <td class="p-2 border">${{ number_format($totalPrice, 2) }}</td>
                            <td class="p-2 border flex space-x-2">
                                <form action="{{ route('cart.increase', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">+</button>
                                </form>
                                <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">-</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4 flex justify-between items-center">
                <h2 class="text-xl font-bold">Grand Total: ${{ number_format($grandTotal, 2) }}</h2>

                <a href="{{ route('checkout.index') }}"
                   class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg font-semibold transition">
                    Checkout
                </a>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
</x-app-layout>
