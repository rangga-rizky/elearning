<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizStudentAnswer extends Model
{
     protected $table = "quiz_student_answers";    
    protected $fillable = ['quiz_question_id', 'user_id', 'answer'];
}
