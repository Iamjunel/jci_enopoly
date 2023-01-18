<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client';

    protected $fillable = ['firstname','lastname', 'email','email','phone','address','rdia','rdia_id','fb_email_address','fb_password','payment_method','company_id','status','added_by'];


    public function company(){
        return $this->belongsTo(Company::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
}
