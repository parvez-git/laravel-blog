<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'body',
        'image'
      ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getImageUrlAttribute($value)
    {
        $imgUrl = "";

        if (! is_null($this->image)) {

            $imgPath = public_path() . "/img/" . $this->image;

            if (file_exists($imgPath)) {

                $imgUrl = asset("/img/" . $this->image);
            }
        }
        return $imgUrl;
    }

  public function getDateAttribute($value)
  {
    return $this->created_at->diffForHumans();
  }
}
