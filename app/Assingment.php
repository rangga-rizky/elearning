<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Assingment extends Model
{
    //

    public function session()
    {
        return $this->belongsTo('App/Session');
    }

     public function studentAssignments()
    {
        return $this->hasMany('App\StudentAssingment');
    }

    
}
