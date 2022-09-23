<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $fillable = [
      'title', 'content', 'published'
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User','user_id','id');
  }
  public function comments(){
      return $this->hasMany('App\Models\Comment','post_id','id');
  }
}
