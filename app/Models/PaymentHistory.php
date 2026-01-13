<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable = [
        'user_id',
        'payment_name',
        'total_amount',
        'payslip_image',
        'payment_method',
        'transaction_id',
        'order_code',
        'voucher_code',
    ];
}
