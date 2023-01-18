<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = ['name', 'email', 'address','phone','added_by'];


    public function client()
    {
        return $this->hasMany(Client::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
}
