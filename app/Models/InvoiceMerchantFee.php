<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceMerchantFee extends Model
{
    use HasFactory;

    protected $table = 'invoice_merchant_fees';

    protected $fillable = ['invoice_id','payment_method','amount','percentage'];

}
