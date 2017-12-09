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
        'username', 'email', 'password','role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     public function role()
    {
        return $this->belongsTo('App\Role');
    }

     public function inRole(string $role)
    {
        return $this->role()->where('name', $role)->count() == 1;
    }

    public function assignments()
    {
        return $this->hasMany('App\Author');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Enrollment');
    }
}
