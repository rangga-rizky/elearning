<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\QuizStudentAnswer;

class QuizStudentAnswerController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }


    public function store(Request $request){
    	$user = Auth::user();

    	foreach ($request->input("answers") as $question) {
    		$data['quiz_question_id'] = $question[0] ;
      		$data['answer'] = $question[1];
		  	$data['user_id'] = $user->id;
			QuizStudentAnswer::create($data);
    	}
    	return sizeof($request->input("answers"));
    }
}
