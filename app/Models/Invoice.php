<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
   use HasFactory;

    protected $table = 'invoice';

    protected $fillable = ['order_id','invoice_number','billing_address','shipping_address','total','status','discount','added_by','notes'];


    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
}

