@extends('layouts.app')
@section('title', 'Add Category')

@section('content')
    <div class="max-w-7xl mx-auto py-6 px-2.5 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6">Add Category</h2>

        <form action="{{ route('categories.store') }}" method="POST"
            class="space-y-4 bg-white shadow-md rounded-xl p-6 w-full">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="w-full p-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500" required>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />

            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('categories.index') }}"
                    class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</a>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Save</button>
            </div>
        </form>
    </div>

@endsection
