<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //protected $guarded = [];


    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        //especificar o nome da coluna pois trocamos o nome para autor
        return $this->belongsTo(User::class, 'user_id');
    }

}
