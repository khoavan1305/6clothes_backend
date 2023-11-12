<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primarykey = 'id';
    protected $guarded = [];
    public function product(){
        return $this->hasMany(product::class,'brand_id','id');
    }
    public function scopeSearch($query){
        if($key=request()->key){
            $query=$query->where('name','like','%'.$key.'%');    
        }
        return $query;
    }
}