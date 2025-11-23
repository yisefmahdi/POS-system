<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'purchase_id',
        'product_name',
        'quantity',
        'purchase_price',
        'total'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
