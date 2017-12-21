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

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function userGroups()
    {
        return $this->hasMany('App\UserGroup');
    }

    public function grades()
    {
        return $this->hasMany('App\Grading');
    }

    public function getGroupsIds(){

        foreach ($this->userGroups()->get() as $user_group) {
            $groupsIds[] = $user_group->group_id;
        }
        return $groupsIds;


    }
}
