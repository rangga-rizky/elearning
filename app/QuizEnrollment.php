<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizEnrollment extends Model
{
    protected $table = "quiz_enrollments";    
    protected $fillable = ['quiz_id', 'user_id', 'score'];
}
