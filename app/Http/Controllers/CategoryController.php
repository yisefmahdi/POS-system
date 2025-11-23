<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // عرض كل الفئات
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // عرض صفحة إنشاء
    public function create()
    {
        return view('categories.create');
    }

    // حفظ فئة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        Category::create($request->only('name'));

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    // عرض صفحة تعديل
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // تحديث الفئة
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $category->update($request->only('name'));

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // حذف الفئة
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }
}
