<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable 
// implements MustVerifyEmail
{
    use SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'status', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function groups()
    {
      return $this->belongsToMany('App\Group', 'group_user', 'user_id', 'group_id')->withTimestamps();
    }

    public function hasGroup($group)
    {
      if ($this->groups()->where('name', $group)->first()) {
        return true;
      }
      return false;
    }

    public function hasAnyGroup($groups)
    {
      if (is_array($groups)) {
        foreach ($groups as $group) {
          if ($this->hasGroup($group)) {
            return true;
          }
        }
        return false;
      } else {
        if ($this->hasGroup($groups)) {
          return true;
        }
        return false;
      }
    }

    public function authorizeGroups($groups)
    {
      if ($this->hasAnyGroup($groups)) {
        return true;
      }
      foreach ($groups as $key => $value) {
        $set = $key." ".$value.",";
      }
      abort(401, "Unauthorized {$set}");
    }
}
