<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // عرض جميع المنتجات
    public function index(Request $request)
    {
        $categories = Category::all(); // لجلب الفئات لقائمة الفلتر

        $query = Product::with('category');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('barcode')) {
            $query->where('barcode', 'like', '%' . $request->barcode . '%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->get();

        return view('products.index', compact('products', 'categories'));
    }


    // صفحة إنشاء منتج
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // حفظ منتج جديد
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'purchase_price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // صفحة تعديل منتج
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // تحديث المنتج
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'barcode' => 'nullable|string|max:255',
            'purchase_price' => 'nullable|numeric',
            'sale_price' => 'nullable|numeric',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // حذف المنتج
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
