<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAssingment extends Model
{
    protected $table = 'student_assignments';
    protected $fillable = ['assingment_id', 'file_path', 'user_id'];

    public function assingment()
    {
        return $this->belongsTo('App\Assingment');
    }
}
