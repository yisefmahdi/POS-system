<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier',
        'invoice_number',
        'payment_method',
        'purchase_date',
        'total_amount',
        'notes',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }

    /**
     * توليد رقم فاتورة تلقائي (اختياري)
     */
    public static function generateInvoiceNumber()
    {
        $year = date('Y');
        $lastPurchase = self::whereYear('created_at', $year)->latest('id')->first();

        if ($lastPurchase) {
            $lastNumber = (int) substr($lastPurchase->invoice_number, -6);
            $nextNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '000001';
        }

        return "PU-{$year}-{$nextNumber}";
    }

    protected $casts = [
        'purchase_date' => 'date',
    ];
}
