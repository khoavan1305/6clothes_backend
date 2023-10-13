<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_like extends Model
{
    use HasFactory;
    protected $table = 'product_like';
    protected $primarykey = 'id';
 
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function products(){
        return $this->belongsTo(product::class,'product_id','id');
    }
}