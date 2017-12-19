<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuizMultipleChoice extends Model
{
    protected $table = "quiz_multiplechoiches";


    public function question()
    {
        return $this->belongsTo('App\QuizQuestion');
    }

}
