@extends('layouts.app')
@section('title', 'Purchases')
@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-2.5 lg:px-8">

        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Purchases</h1>
            <a href="{{ route('purchases.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Add Purchase</a>
        </div>

        <div class="mb-4 bg-white shadow-md rounded-xl p-4">
            <form method="GET" action="{{ route('purchases.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <input type="text" name="supplier" value="{{ request('supplier') }}" placeholder="Leverancier"
                    class="p-2 border rounded-xl w-full">

                <input type="text" name="invoice_number" value="{{ request('invoice_number') }}"
                    placeholder="Factuurnummer" class="p-2 border rounded-xl w-full">

                <input type="date" name="purchase_date" value="{{ request('purchase_date') }}"
                    class="p-2 border rounded-xl w-full">

                <div class="flex space-x-2 col-span-2">
                    <button type="submit" style="width: 100px"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                        Zoeken
                    </button>

                    <a href="{{ route('purchases.index') }}" style="width: 130px"
                        class="py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500 text-center">
                        Filter annuleren
                    </a>
                </div>
            </form>
        </div>

        @if ($purchases->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg text-center mb-4">
                No purchases yet.
            </div>
        @else
            <div class="bg-white shadow-md rounded-xl overflow-hidden">

                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Supplier</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Invoice</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-6 py-3 text-right text-sm font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($purchases as $purchase)
                            <tr>
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $purchase->supplier }}</td>
                                <td class="px-6 py-4">{{ $purchase->invoice_number }}</td>
                                <td class="px-6 py-4">{{ $purchase->purchase_date }}</td>
                                <td class="px-6 py-4">{{ $purchase->total_amount }}</td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <!-- زر عرض الفاتورة -->
                                    <a href="{{ route('purchases.show', $purchase) }}"
                                        class="px-3 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                        Bekijk
                                    </a>

                                    <!-- زر تعديل الفاتورة -->
                                    <a href="{{ route('purchases.edit', $purchase) }}"
                                        class="px-3 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                                        Edit
                                    </a>

                                    <!-- زر حذف الفاتورة -->
                                    <form action="{{ route('purchases.destroy', $purchase) }}" method="POST"
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
                text: "This purchase will be deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>
@endsection
