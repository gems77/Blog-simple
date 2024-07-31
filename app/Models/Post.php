<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $primaryKey="id";
    protected $table="posts";
    
    protected $filable=[
       "title",
       "content"
    ];
    public function comments()
    {
        return $this->hasMany(Comment::class,"post_id","id");
    }
    
    protected static function boot()
    
    {
        parent::boot();
        
        static::deleting(function($post){
            $post->comments()->delete();
        });
    }
}
