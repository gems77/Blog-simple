<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    
    protected $primaryKey="id";
    protected $table="comments";
    
    protected $filable=[
       "post_id",
       "author_name",
       "content"
    ];
    
    public function comment(){
        return $this->belongsTo(Post::class, "post_id", "id");
    }
}
