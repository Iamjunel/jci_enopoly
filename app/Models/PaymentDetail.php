<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;


    protected $table = 'payment_details';

    protected $fillable = ['name', 'billing_address', 'number', 'type','client_id','added_by'];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
}
