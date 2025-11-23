<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $fillable = [
        'code',
        'used_count',
        'start_date',
        'end_date',
        'value',
        'type',
    ];
}
