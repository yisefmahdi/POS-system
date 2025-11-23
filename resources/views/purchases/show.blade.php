@extends('layouts.app')
@section('title', 'Inkoopfactuur bekijken')
@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-md rounded-xl p-6">

    <h1 class="text-2xl font-bold mb-4">Inkoopfactuur bekijken</h1>

    <!-- Factuurinformatie -->
    <div class="grid grid-cols-2 gap-4 mb-6">

        <div>
            <h3 class="font-semibold text-gray-700">Leverancier:</h3>
            <p>{{ $purchase->supplier }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-gray-700">Factuurnummer:</h3>
            <p>{{ $purchase->invoice_number }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-gray-700">Betaalmethode:</h3>
            <p>{{ $purchase->payment_method }}</p>
        </div>

        <div>
            <h3 class="font-semibold text-gray-700">Aankoopdatum:</h3>
            <p>{{ $purchase->purchase_date->format('Y-m-d') }}</p>
        </div>

        <div class="col-span-2">
            <h3 class="font-semibold text-gray-700">Opmerkingen:</h3>
            <p>{{ $purchase->notes ?? 'Geen' }}</p>
        </div>

    </div>

    <!-- Productenlijst -->
    <h2 class="text-xl font-semibold mb-3">Productdetails</h2>

    <table class="w-full border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">Productnaam</th>
                <th class="border p-2">Aantal</th>
                <th class="border p-2">Aankoopprijs</th>
                <th class="border p-2">Totaal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($purchase->purchaseItems as $item)
                <tr>
                    <td class="border p-2">{{ $item->product_name }}</td>
                    <td class="border p-2">{{ $item->quantity }}</td>
                    <td class="border p-2">{{ number_format($item->purchase_price, 2) }}</td>
                    <td class="border p-2">{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Eindtotaal -->
    <div class="text-right mt-4">
        <h3 class="text-xl font-bold">Totaalbedrag: {{ number_format($purchase->total_amount, 2) }}</h3>
    </div>

    <!-- Terug -->
    <div class="mt-6">
        <a href="{{ route('purchases.index') }}"
           class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Terug
        </a>
    </div>

</div>
@endsection
