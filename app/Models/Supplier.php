<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';
    
    protected $fillable = ['firstname','lastname','email','phone','asin','company_name','website_link','types','added_by','notes','status','checker_notes','checker_updated_at','checker_id','caller_notes','caller_updated_at','caller_id','csv_link','username','password'];

    public function user()
    {
        return $this->belongsTo(User::class,'added_by','id');
    }
    public function checker()
    {
        return $this->belongsTo(User::class,'checker_id','id');
    }
    public function caller()
    {
        return $this->belongsTo(User::class,'caller_id','id');
    }
}
