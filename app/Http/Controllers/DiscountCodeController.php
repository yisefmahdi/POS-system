<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use Illuminate\Http\Request;

class DiscountCodeController extends Controller
{
    public function index()
    {
        $discountCodes = DiscountCode::all();
        return view('discount-codes.index', compact('discountCodes'));
    }

    public function create()
    {
        return view('discount-codes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:discount_codes,code',
            'value' => 'required|numeric',
            'type' => 'required|in:percent,fixed',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        DiscountCode::create($request->all());

        return redirect()->route('discount-codes.index')->with('success', 'Discount code created successfully!');
    }

    public function edit(DiscountCode $discount_code)
    {
        return view('discount-codes.edit', compact('discount_code'));
    }

    public function update(Request $request, DiscountCode $discount_code)
    {
        $request->validate([
            'code' => 'required|unique:discount_codes,code,' . $discount_code->id,
            'value' => 'required|numeric',
            'type' => 'required|in:percent,fixed',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $discount_code->update($request->all());

        return redirect()->route('discount-codes.index')->with('success', 'Discount code updated successfully!');
    }

    public function destroy(DiscountCode $discount_code)
    {
        $discount_code->delete();

        return redirect()->route('discount-codes.index')->with('success', 'Discount code deleted successfully!');
    }
}
