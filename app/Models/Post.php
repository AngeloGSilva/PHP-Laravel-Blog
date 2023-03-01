<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //ambas instrucoes fazem o msm... mass assined mas uma diz quais podem ser e a outra as que nao podem.. id nao pode ...
    protected $guarded = ['id'];//quais nao permite
    //protected $fillable = ['title', 'excerpt', 'body', 'category_id', 'slug']; //quais permite

    //maneira diferente de dar load a estes parametros sempre q pedes post..
    //para nao fazer lazy .. mas é melhor a q ja esta feita na web.php
    //protected $with = ['category','author'];

    public function scopeFilter($query, array $filters)
    {
        //Post::newQuery()->filter();
        //ou usando um Query Builder
        $query->when($filters['search'] ?? false, fn($query, $search) =>
            $query->where(fn($query) =>
                $query->where('title','like','%' . $search .'%')
                ->orWhere('body','like','%' . $search .'%')
        ));

        // if ($filters['search'] ?? false) {
        //     $query->where('title', 'like', '%' . request('search') . '%')->orwhere('body', 'like', '%' . request('search') . '%');
        // }

        $query->when($filters['category'] ?? false, fn($query, $category) =>
           $query->whereHas('category',fn($query) =>
                $query->where('slug',$category)
            )
        );

        $query->when($filters['author'] ?? false, fn($query, $author) =>
            $query->whereHas('author',fn($query) =>
                $query->where('username',$author)
         )
     );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        // author_id
        return $this->belongsTo(User::class, 'user_id');
    }
}
