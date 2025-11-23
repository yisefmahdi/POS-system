@extends('layouts.app')
@section('title', 'Add Discount Code')
@section('content')
    <div class="max-w-7xl mx-auto py-6 px-2.5 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-6">Add Discount Code</h2>

        <form action="{{ route('discount-codes.store') }}" method="POST" class="space-y-4 bg-white shadow-md rounded-xl p-6">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-2">Code</label>
                <input type="text" name="code" value="{{ old('code') }}"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500" required>
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Value</label>
                <input type="number" step="0.01" name="value" value="{{ old('value') }}"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500" required>
                <x-input-error :messages="$errors->get('value')" class="mt-2" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Type</label>
                <select name="type"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500" required>
                    <option value="percent" {{ old('type') == 'percent' ? 'selected' : '' }}>Percent</option>
                    <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                </select>
                <x-input-error :messages="$errors->get('type')" class="mt-2" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">Start Date</label>
                <input type="date" name="start_date" value="{{ old('start_date') }}"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
                <x-input-error :messages="$errors->get('start_date')" class="mt-2" />

            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-2">End Date</label>
                <input type="date" name="end_date" value="{{ old('end_date') }}"
                    class="w-full p-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500">
                <x-input-error :messages="$errors->get('end_date')" class="mt-2" />

            </div>

            <div class="flex justify-end space-x-2">
                <a href="{{ route('discount-codes.index') }}"
                    class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Cancel</a>
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Save</button>
            </div>
        </form>
    </div>
@endsection
