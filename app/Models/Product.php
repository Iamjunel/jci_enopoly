<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = ['order','supplier_cost','multipack','final_supplier_cost','selling_price','fba_fees','label_cost','shipping_fee','prep_fee','inbound_shipment',
    'profit_per_piece','total_cost','total_profit','margin','monthly_sales','compt_sellers','process','status','qa_status','agent', 'added_by'];

    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
}
