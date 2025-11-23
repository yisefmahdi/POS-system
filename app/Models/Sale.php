<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number','subtotal','discount_amount','tax_amount','final_amount',
        'payment_method','notes','user_id','invoice_type'
    ];

    protected static function boot()
    {
        parent::boot();

        // قبل إنشاء أي سجل جديد
        static::creating(function ($sale) {
            if (empty($sale->invoice_number)) {
                $sale->invoice_number = self::generateInvoiceNumber();
            }
        });
    }

    public static function generateInvoiceNumber()
    {
        $year = date('Y');
        $lastSale = self::whereYear('created_at', $year)->latest('id')->first();

        if ($lastSale) {
            // الرقم التسلسلي = الرقم الأخير + 1
            $lastNumber = (int) substr($lastSale->invoice_number, -6);
            $nextNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $nextNumber = '000001';
        }

        return "SP-{$year}-{$nextNumber}";
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function saleItems() {
        return $this->hasMany(SaleItem::class);
    }
}

