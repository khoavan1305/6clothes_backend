<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $primarykey = 'id';
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }
    public function blog_comment(){
        return $this->hasMany(blog_comment::class,'blog_id','id');
    }
}