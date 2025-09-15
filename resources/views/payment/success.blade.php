<x-app-layout>
    <div class="max-w-4xl mx-auto mt-6 bg-white shadow p-6 rounded-lg text-center">
        <h1 class="text-2xl font-bold mb-4">Payment Successful!</h1>
        <p class="mb-6">Thank you for your payment.</p>

        <a href="{{ route('dashboard') }}"
            class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold">
            Return to Dashboard
        </a>
    </div>
</x-app-layout>
