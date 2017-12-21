<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grading extends Model
{
    public function user(){
    	return $this->belongsTo('App\User');
    }
   

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

     public function group(){
    	return $this->belongsTo('App\Group');
    }

     public function teacher(){
    	return $this->belongsTo('App\User','teacher_id');
    }
}
