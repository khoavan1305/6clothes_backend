<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog_comment extends Model
{
    use HasFactory;
    protected $table = 'blog_comments';
    protected $primarykey = 'id';
    protected $guarded = [];

    public function blog(){
        return $this->belongsTo(blog::class,'blog_id','id');
    }
}