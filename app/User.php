<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
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
    public function reads()
    {
      return $this->belongsToMany('App\Book', 'reads')->withPivot('page');
    }
    public function views()
    {
      return $this->belongsToMany('App\Book', 'authorized_views');
    }
    public function downloads()
    {
      return $this->belongsToMany('App\Book', 'authorized_downloads');
    }
    public function books()
    {
      return $this->hasMany('App\Book', 'adder_id');
    }
  public function role()
  {
    return $this->belongsTo('App\Role');
  }
  public function toArray(){
    return array(
      "id" => $this->id,
      "name" => $this->name,
      "email" => $this->email,
      "reads" => $this->reads
    );
  } 
}
