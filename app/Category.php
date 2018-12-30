<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'title', 'slug',
    ];

    public function posts()
    {
    	return $this->hasMany(Post::class);
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}
