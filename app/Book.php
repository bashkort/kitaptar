<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use AlgoliaSearch\Laravel\AlgoliaEloquentTrait;
use Illuminate\Support\Facades\Auth;

class Book extends Model
{
    use AlgoliaEloquentTrait;
    public function liked() {
	return (bool) Like::where('user_id', Auth::id())
		 ->where('book_id', $this->id)
		 ->first();
    }
    public function files()
    {
      return $this->hasMany('App\File');
    }
    public function likes()
    {
      return $this->belongsToMany('App\User', 'likes');
    }
    public function views()
    {
      return $this->belongsToMany('App\User', 'views');
    }
    public function downloads()
    {
      return $this->belongsToMany('App\User', 'downloads');
    }
    public function adder()
    {
      return $this->belongsTo('App\User');
    }
}
