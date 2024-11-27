<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Posts extends Model
{
    use HasFactory;
    protected $fillable = [ 
        "title",
        "content",
    ];

    public function posts(){
        return $this->hasMany(Post::class); 
    }
}
