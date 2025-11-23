@extends('layouts.app')
@section('title', 'Edit Product')
@section('content')
<div class="max-w-7xl mx-auto py-6 px-2.5 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

    <form action="{{ route('products.update', $product) }}" method="POST" class="space-y-4 bg-white shadow-md rounded-xl p-6">
        @csrf
        <div>
            <label class="block text-gray-700 font-medium mb-2">Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500" required>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Category</label>
            <select name="category_id" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id)==$category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2"/>
        </div>

        <div class="flex space-x-2">
            <div class="flex-1">
                <label class="block text-gray-700 font-medium mb-2">Purchase Price</label>
                <input type="number" step="0.01" name="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
            </div>
            <div class="flex-1">
                <label class="block text-gray-700 font-medium mb-2">Sale Price</label>
                <input type="number" step="0.01" name="sale_price" value="{{ old('sale_price', $product->sale_price) }}" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
            </div>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Stock</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Barcode</label>
            <input type="text" name="barcode" value="{{ old('barcode', $product->barcode) }}" class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
        </div>

        <div class="flex justify-end space-x-2">
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Save</button>
        </div>
    </form>
</div>
@endsection
