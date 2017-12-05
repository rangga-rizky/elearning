<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    
    public function assignments()
    {
        return $this->hasMany('App\Assingment');
    }
}
