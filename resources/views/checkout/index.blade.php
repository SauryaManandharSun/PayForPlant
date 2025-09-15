<x-app-layout>
    <div class="max-w-4xl mx-auto mt-6 bg-white shadow p-6 rounded-lg">
        <h1 class="text-2xl font-bold mb-4">Checkout</h1>

        @if (count($cart) > 0)
            <table class="w-full border mb-6">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2 border">Product</th>
                        <th class="p-2 border">Unit Price</th>
                        <th class="p-2 border">Quantity</th>
                        <th class="p-2 border">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php $grandTotal = 0; @endphp
                    @foreach ($cart as $item)
                        @php
                            $total = $item['price'] * $item['quantity'];
                            $grandTotal += $total;
                        @endphp
                        <tr>
                            <td class="p-2 border">{{ $item['name'] }}</td>
                            <td class="p-2 border">Rs. {{ number_format($item['price'], 2) }}</td>
                            <td class="p-2 border">{{ $item['quantity'] }}</td>
                            <td class="p-2 border">Rs. {{ number_format($total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @php
                $amount = number_format($grandTotal, 2, '.', '');
                $tax_amount = '0.00';
                $service_charge = '0.00';
                $delivery_charge = '0.00';
                $total_amount = number_format($amount + $tax_amount + $service_charge + $delivery_charge, 2, '.', '');
                $transaction_uuid = now()->format('YmdHis'); 
                $product_code = 'EPAYTEST';
                $signed_fields = 'total_amount,transaction_uuid,product_code';
            @endphp

            <form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST"
                onsubmit="generateSignature()">
                <input type="hidden" name="amount" value="{{ $amount }}">
                <input type="hidden" name="tax_amount" value="{{ $tax_amount }}">
                <input type="hidden" name="total_amount" id="total_amount" value="{{ $total_amount }}">
                <input type="hidden" name="transaction_uuid" id="transaction_uuid" value="{{ $transaction_uuid }}">
                <input type="hidden" name="product_code" id="product_code" value="{{ $product_code }}">
                <input type="hidden" name="product_service_charge" value="{{ $service_charge }}">
                <input type="hidden" name="product_delivery_charge" value="{{ $delivery_charge }}">
                <input type="hidden" name="success_url" value="{{ route('payment.success') }}">
                <input type="hidden" name="failure_url" value="{{ route('payment.failure') }}">
                <input type="hidden" name="signed_field_names" value="{{ $signed_fields }}">
                <input type="hidden" name="signature" id="signature">

                <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold">
                    Pay with eSewa
                </button>
            </form>
        @else
            <p>Your cart is empty.</p>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>

    <script>
        function generateSignature() {
            var currentTime = new Date();
            var formattedTime = currentTime.toISOString().slice(2, 10).replace(/-/g, '') + '-' +
                currentTime.getHours() + currentTime.getMinutes() + currentTime.getSeconds();
            document.getElementById("transaction_uuid").value = formattedTime;

            var total_amount = document.getElementById("total_amount").value;
            var transaction_uuid = document.getElementById("transaction_uuid").value;
            var product_code = document.getElementById("product_code").value;
            var secret = "8gBm/:&EnhH.1/q";

            var hash = CryptoJS.HmacSHA256(
                `total_amount=${total_amount},transaction_uuid=${transaction_uuid},product_code=${product_code}`,
                secret
            );
            var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);
            document.getElementById("signature").value = hashInBase64;

            console.log("Data String: total_amount=" + total_amount + ",transaction_uuid=" + transaction_uuid +
                ",product_code=" + product_code);
            console.log("Signature: " + hashInBase64);
        }
    </script>
</x-app-layout>
```
