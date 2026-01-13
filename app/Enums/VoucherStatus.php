<?php

namespace App\Enums;

enum VoucherStatus: string
{
    case Active = 'active';
    case Expired = 'expired';
}
