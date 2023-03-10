<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['purchase_order', 'description', 'total','status','supplier_id','added_by','updated_by','store_id','approved_by'];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
    public function approved()
    {
        return $this->belongsTo(User::class,'approved_by','id');
    }
    public function store()
    {
        return $this->belongsTo(StoreDetail::class,'store_id','id');
    }
}
