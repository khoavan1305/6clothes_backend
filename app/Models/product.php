<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primarykey = 'id';
    protected $guarded = [];
    
    public function brand(){
        return $this->belongsTo(brand::class,'brand_id','id');
    }
    public function product_catelogy(){
        return $this->belongsTo(product_catelogy::class,'product_category_id','id');
    }
    public function product_detaill(){
        return $this->hasMany(product_detaill::class,'product_id','id');
    }
    public function product_comment(){
        return $this->hasMany(product_comment::class,'product_id','id');
    }
    public function order_detaill(){
        return $this->hasMany(order_detaill::class,'product_id','id');
    }
    public function product_like(){
        return $this->hasOne(product_like::class,'product_id','id');
    }
    public function scopeSearch($query){
        if($key=request()->key){
            $query=$query->where('name','like','%'.$key.'%');
        }
        if($featured=request()->featured){
            $query=$query->orderBy('id','desc')->where('featured',$featured);    
        }
        return $query;
    }
}