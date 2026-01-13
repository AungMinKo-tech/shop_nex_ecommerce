<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    protected $fillable = [
        'account_number',
        'account_name',
        'account_type',
    ];
}
