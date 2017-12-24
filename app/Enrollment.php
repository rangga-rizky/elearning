<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
	public $timestamps = false;

     protected $fillable = [
        'course_id', 'group_id'
    ];

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }
    
}
