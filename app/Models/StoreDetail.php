<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreDetail extends Model
{
    use HasFactory;

    protected $table = 'store_details';

    protected $fillable = ['platform', 'name', 'link', 'username', 'password','client_id','added_by'];


    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
    
}
