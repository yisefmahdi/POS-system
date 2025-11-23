<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        // بناء الاستعلام الأساسي
        $query = Purchase::with('purchaseItems')->latest();

        // فلترة حسب المورد
        if ($request->filled('supplier')) {
            $query->where('supplier', 'like', '%' . $request->supplier . '%');
        }

        // فلترة حسب رقم الفاتورة
        if ($request->filled('invoice_number')) {
            $query->where('invoice_number', 'like', '%' . $request->invoice_number . '%');
        }

        // فلترة حسب تاريخ الشراء
        if ($request->filled('purchase_date')) {
            $query->where('purchase_date', $request->purchase_date);
        }

        // تنفيذ الاستعلام
        $purchases = $query->get();

        return view('purchases.index', compact('purchases'));
    }


    public function show($id)
    {
        $purchase = Purchase::with('purchaseItems')->findOrFail($id);

        return view('purchases.show', compact('purchase'));
    }

    public function create()
    {
        $products = Product::all();
        return view('purchases.create', compact('products'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'supplier' => 'nullable|string|max:255',
            'payment_method' => 'required|in:Cash,Bank,Later',
            'purchase_date' => 'required|date',
            'products.*.product_name' => 'required|string|max:255',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.purchase_price' => 'required|numeric|min:0',
        ]);

        $total = collect($request->products)->sum(function ($item) {
            return $item['quantity'] * $item['purchase_price'];
        });

        $purchase = Purchase::create([
            'supplier' => $request->supplier,
            'invoice_number' => Purchase::generateInvoiceNumber(),
            'payment_method' => $request->payment_method,
            'purchase_date' => $request->purchase_date,
            'total_amount' => $total,
            'notes' => $request->notes,
            'user_id' => Auth::user()->id,
        ]);

        foreach ($request->products as $item) {
            $purchase->purchaseItems()->create([
                'product_name' => $item['product_name'], // اسم المنتج مباشرة
                'quantity' => $item['quantity'],
                'purchase_price' => $item['purchase_price'],
                'total' => $item['quantity'] * $item['purchase_price'],
            ]);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase created successfully!');
    }

    public function edit(Purchase $purchase)
    {
        return view('purchases.edit', compact('purchase'));
    }


    public function update(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier' => 'nullable|string|max:255',
            'payment_method' => 'required|in:Cash,Bank,Later',
            'purchase_date' => 'required|date',
            'products.*.product_name' => 'required|string|max:255',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.purchase_price' => 'required|numeric|min:0',
        ]);

        $purchase->update([
            'supplier' => $request->supplier,
            'purchase_date' => $request->purchase_date,
            'payment_method' => $request->payment_method,
            'total_amount' => collect($request->products)->sum(fn($item) => $item['quantity'] * $item['purchase_price']),
            'notes' => $request->notes,
        ]);

        // حذف الايتيم القديم واعادة الانشاء
        $purchase->purchaseItems()->delete();

        foreach ($request->products as $item) {
            $purchase->purchaseItems()->create([
                'product_name' => $item['product_name'],
                'quantity' => $item['quantity'],
                'purchase_price' => $item['purchase_price'],
                'total' => $item['quantity'] * $item['purchase_price'],
            ]);
        }

        return redirect()->route('purchases.index')->with('success', 'Purchase updated successfully!');
    }


    public function destroy(Purchase $purchase)
    {
        $purchase->delete();
        return redirect()->route('purchases.index')->with('success', 'Purchase deleted successfully!');
    }
}
