@extends('layouts.app')
@section('title', 'Edit Purchase')
@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">Edit Purchase</h2>

    <form action="{{ route('purchases.update', $purchase) }}" method="POST" class="space-y-4 bg-white shadow-md rounded-xl p-6">
        @csrf

        <div>
            <label class="block text-gray-700 font-medium mb-2">Supplier</label>
            <input type="text" name="supplier" value="{{ old('supplier', $purchase->supplier) }}"
                class="w-full p-2 border border-gray-300 rounded-xl" placeholder="Supplier Name">
            <x-input-error :messages="$errors->get('supplier')" class="mt-2" />
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Purchase Date</label>
   <input type="date" name="purchase_date"
       value="{{ old('purchase_date', $purchase->purchase_date ? $purchase->purchase_date->format('Y-m-d') : '') }}"
       class="w-full p-2 border border-gray-300 rounded-xl">

            <x-input-error :messages="$errors->get('purchase_date')" class="mt-2" />
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Payment Method</label>
            <select name="payment_method" class="w-full p-2 border border-gray-300 rounded-xl">
                <option value="Cash" {{ $purchase->payment_method == 'Cash' ? 'selected' : '' }}>Cash</option>
                <option value="Bank" {{ $purchase->payment_method == 'Bank' ? 'selected' : '' }}>Bank</option>
                <option value="Later" {{ $purchase->payment_method == 'Later' ? 'selected' : '' }}>Later</option>
            </select>
            <x-input-error :messages="$errors->get('payment_method')" class="mt-2" />
        </div>

        <div class="products-container space-y-4">
            <h3 class="font-semibold mb-2">Products</h3>
            @foreach($purchase->purchaseItems as $index => $item)
                <div class="product-row flex space-x-2">
                    <input type="text" name="products[{{ $index }}][product_name]" value="{{ old("products.$index.product_name", $item->product_name) }}"
                        placeholder="Product Name" class="flex-1 p-2 border border-gray-300 rounded-xl" required>
                    <input type="number" name="products[{{ $index }}][quantity]" value="{{ old("products.$index.quantity", $item->quantity) }}" min="1" placeholder="Quantity"
                        class="w-24 p-2 border border-gray-300 rounded-xl">
                    <input type="number" step="0.01" name="products[{{ $index }}][purchase_price]" value="{{ old("products.$index.purchase_price", $item->purchase_price) }}"
                        placeholder="Price" class="w-32 p-2 border border-gray-300 rounded-xl">
                    <button type="button" class="remove-product bg-red-500 text-white px-3 rounded-lg">-</button>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 font-medium mb-2">Total Amount</label>
            <input type="number" step="0.01" name="total_amount" value="{{ old('total_amount', $purchase->total_amount) }}" readonly
                class="w-40 p-2 border border-gray-300 rounded-xl bg-gray-100" id="total_amount">
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Notes</label>
            <textarea name="notes" class="w-full p-2 border border-gray-300 rounded-xl">{{ old('notes', $purchase->notes) }}</textarea>
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('purchases.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Update</button>
        </div>
    </form>
</div>
@endsection
@section('js')
    <script>
        let productIndex = 1;
        document.querySelector('.products-container').addEventListener('click', function(e) {
            if (e.target.classList.contains('add-product')) {
                const container = document.createElement('div');
                container.classList.add('product-row', 'flex', 'space-x-2');
                container.innerHTML = `
            <input type="text" name="products[${productIndex}][product_name]" placeholder="Product Name" class="flex-1 p-2 border border-gray-300 rounded-xl" required>
            <input type="number" name="products[${productIndex}][quantity]" value="1" min="1" placeholder="Quantity" class="w-24 p-2 border border-gray-300 rounded-xl">
            <input type="number" step="0.01" name="products[${productIndex}][purchase_price]" value="0.00" placeholder="Price" class="w-32 p-2 border border-gray-300 rounded-xl">
            <button type="button" class="remove-product bg-red-500 text-white px-3 rounded-lg">-</button>
        `;
                document.querySelector('.products-container').appendChild(container);
                productIndex++;
            }

            if (e.target.classList.contains('remove-product')) {
                e.target.closest('.product-row').remove();
            }

            calculateTotal(); // إعادة حساب المجموع عند الحذف
        });

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.product-row').forEach(row => {
                const qty = parseFloat(row.querySelector('input[name*="[quantity]"]').value) || 0;
                const price = parseFloat(row.querySelector('input[name*="[purchase_price]"]').value) || 0;
                total += qty * price;
            });
            document.getElementById('total_amount').value = total.toFixed(2);
        }

        // حدث لكل تغيير في الكمية أو السعر
        document.querySelector('.products-container').addEventListener('input', function(e) {
            if (e.target.matches('input[name*="[quantity]"], input[name*="[purchase_price]"]')) {
                calculateTotal();
            }
        });
    </script>
@endsection
