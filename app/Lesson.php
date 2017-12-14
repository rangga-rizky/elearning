<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function session()
    {
        return $this->belongsTo('App\Session');
    }

    public function scopeType($flag){
        return $this->where('modul_type',$flag);
    }
}
