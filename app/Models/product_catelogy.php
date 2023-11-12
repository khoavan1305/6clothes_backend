<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_catelogy extends Model
{
    use HasFactory;
    protected $table = 'product_catelogy';
    protected $primarykey = 'id';
    protected $guarded = [];
    public function product(){
        return $this->hasMany(product::class,'product_category_id','id');
    }
    public function scopeSearch($query){
        if($key=request()->key){
            $query=$query->where('name','like','%'.$key.'%');    
        }
        return $query;
    }
}