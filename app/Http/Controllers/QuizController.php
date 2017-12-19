<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\QuizQuestion;
use App\QuizEnrollment;
use Carbon\Carbon;
use Auth;
use Gate;

class QuizController extends Controller
{
    //
	public function __construct()
    {
        $this->middleware('auth');
    }

    //menampilkan quiz berdasarkan id untuk user member course
    public function showForUser($quiz_id){
    	$user = Auth::user();
    	$quiz = Quiz::where("id",$quiz_id)->first();
    	$quizEnrollments = QuizEnrollment::where("user_id",$user->id)->where("quiz_id",$quiz_id)->first();

        $dt = Carbon::parse($quiz['closed_time']);
        $quiz["remaining"] = $dt->diffForHumans(Carbon::now());
        $quiz['closed_time'] = $dt->formatLocalized('%A %d %B %Y');
       
        
        return view('student/quiz', ['user' => $user,
                                    'quiz' =>  $quiz ,
                                    'quizEnrollments' => $quizEnrollments]);

    }

    public function startQuiz(Request $request,$quiz_id){
    	$user = Auth::user();
        $quiz = Quiz::find($quiz_id);
        $questions = QuizQuestion::where("quiz_id",$quiz_id)->orderBy("number_order")->paginate(1);
        if ($request->ajax()) {
            return view('student/load_question', ['questions' => $questions])->render();  
        }
        $this->authorize('start-quiz', $quiz_id);
        $data["user_id"] = $user->id;
        $data["quiz_id"] = $quiz_id;
            QuizEnrollment::create($data);
            return view('student/quiz_start', ['user' => $user,
                                            'quiz' =>$quiz,
                                            'questions' => $questions]);

    }

}
