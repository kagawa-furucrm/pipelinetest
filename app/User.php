<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Auth\Passwords\CanResetPassword;
//use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends Authenticatable{
    use Notifiable;
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';	
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    // user has many posts
  public function posts()
  {
    return $this->hasMany('App\Posts','author_id');
  }
  // user has many comments
  public function comments()
  {
    return $this->hasMany('App\Comments','from_user');
  }
  public function can_post()
  {
    $role = $this->role;
    if($role == 'author' || $role == 'admin')
    {
      return true;
    }
    return false;
  }
  public function is_admin()
  {
    $role = $this->role;
    if($role == 'admin')
    {
      return true;
    }
    return false;
  }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
