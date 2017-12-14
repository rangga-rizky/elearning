<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAssingment extends Model
{
    protected $table = 'student_assignments';
    protected $fillable = ['assignment_id', 'file_path', 'user_id','status'];

    public function assingment()
    {
        return $this->belongsTo('App\Assingment');
    }
}
