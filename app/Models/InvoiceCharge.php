<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceCharge extends Model
{
  use HasFactory;

    protected $table = 'invoice_charges';

    protected $fillable = ['invoice_id','name','amount'];


}
