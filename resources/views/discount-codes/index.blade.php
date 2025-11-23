@extends('layouts.app')
@section('title', 'Discount Codes')
@section('content')
<div class="max-w-7xl mx-auto py-6 px-2.5 sm:px-6 lg:px-8">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Discount Codes</h1>
        <a href="{{ route('discount-codes.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Add Code</a>
    </div>

    @if ($discountCodes->isEmpty())
        <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg text-center mb-4">
            There are no discount codes yet.
        </div>
    @else
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">#</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Code</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Value</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">Start</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 uppercase">End</th>
                        <th class="px-6 py-3 text-right text-sm font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($discountCodes as $code)
                        <tr>
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $code->code }}</td>
                            <td class="px-6 py-4">{{ $code->value }}</td>
                            <td class="px-6 py-4">{{ $code->type }}</td>
                            <td class="px-6 py-4">{{ $code->start_date }}</td>
                            <td class="px-6 py-4">{{ $code->end_date }}</td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('discount-codes.edit', $code) }}" class="px-5 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">Edit</a>
                                <form action="{{ route('discount-codes.destroy', $code) }}" method="POST" class="inline-block" onsubmit="return confirmDelete(event, this)">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded-lg hover:bg-red-600">Delete</button>
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
        text: "This discount code will be deleted!",
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
