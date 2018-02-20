<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content','post_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function getDateAttribute($value)
    {
      return $this->created_at->diffForHumans();
    }
}
