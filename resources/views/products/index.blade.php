@extends('layouts.app')
@section('title', 'Products')
@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-2.5 lg:px-8">

        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Products</h1>
            <a href="{{ route('products.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Add Product</a>
        </div>
        <div class="mb-4 bg-white shadow-md rounded-xl p-4">
            <form method="GET" action="{{ route('products.index') }}"
                class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                <!-- بحث حسب الاسم -->
                <input type="text" name="name" value="{{ request('name') }}" placeholder="Product Name"
                    class="p-2 border rounded-xl w-full">

                <!-- بحث حسب الباركود -->
                <input type="text" name="barcode" value="{{ request('barcode') }}" placeholder="Barcode"
                    class="p-2 border rounded-xl w-full">

                <!-- بحث حسب الفئة -->
                <select name="category_id" class="p-2 border rounded-xl w-full">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div class="flex space-x-2 col-span-2">
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Zoeken
                    </button>

                    <a href="{{ route('products.index') }}" style="width: 130px"
                        class="py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 text-center">
                        Filter annuleren
                    </a>
                </div>

            </form>
        </div>

        @if ($products->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg text-center mb-4">
                No products added yet.
            </div>
        @else
            <div class="bg-white shadow-md rounded-xl overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Barcode</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Purchase Price</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Sale Price</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Stock</th>
                            <th class="px-6 py-3 text-right text-sm font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $product->name }}</td>
                                <td class="px-6 py-4">{{ $product->barcode ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $product->category->name ?? '-' }}</td>
                                <td class="px-6 py-4">€{{ number_format($product->purchase_price, 2) }}</td>
                                <td class="px-6 py-4">€{{ number_format($product->sale_price, 2) }}</td>
                                <td class="px-6 py-4">{{ $product->stock }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <a href="{{ route('products.edit', $product) }}"
                                        class="px-5 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Edit</a>
                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                        class="inline-block" onsubmit="return confirmDelete(event, this)">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif

    </div>
@endsection

@section('js')
    <script>
        function confirmDelete(event, form) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "This product will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        }
    </script>
@endsection
