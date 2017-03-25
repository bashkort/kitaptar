<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function likes()
    {
      return $this->belongsToMany('App\Book', 'likes');
    }
    public function views()
    {
      return $this->belongsToMany('App\Book', 'views');
    }
    public function downloads()
    {
      return $this->belongsToMany('App\Book', 'downloads');
    }
    public function books()
    {
      return $this->hasMany('App\Book', 'adder_id');
    }
}
