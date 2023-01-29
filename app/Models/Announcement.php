<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = 'announcement';

    protected $fillable = ['message','added_by','added_by'];


   
    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
}
