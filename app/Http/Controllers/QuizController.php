<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Course;
use App\Quiz;
use App\QuizQuestion;
use App\QuizEnrollment;
use Carbon\Carbon;
use Auth;
use DB;
use Gate;
use Session as Flash;

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
        $is_opened = 1;
        if (strtotime($quiz['closed_time'] ) < time()) {
            $is_opened = 0;
        }
        $quiz['closed_time'] = $dt->formatLocalized('%A %d %B %Y');     
        
        return view('student/quiz', ['user' => $user,
                                    'is_opened' => $is_opened,
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

    public function createBySessionId($sess_id, $course_id)
    {
        $user = Auth::user();
        $session = Session::where("id",$sess_id)->first();
        $course = Course::where("id",$course_id)->first();
        return view('teachers/quiz-form', ['user' => $user,
                                    'session' =>  $session ,
                                    'course' => $course,
                                    's_id'=>$sess_id]);
    }

    public function storeBySessionId(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'title' => 'required',
            'closed_time'=>'required',
            'session' => 'required'
        ]);

        $id = DB::table('quiz')->insertGetId(
            [
                'session_id' => $request->input('session'), 
                'title' => $request->input('title'),
                'closed_time' => $request->input('closed_time')
            ]
        );
        Flash::flash('flash_message', 'A quiz successfully added!');
        return redirect('/quiz/manage-on-course/'.$request->input('session').'/'.$request->input('c_id'));

    }

    public function editByTeacher($id, $s_id, $c_id)
    {
        $user = Auth::user();
        $session = Session::where("id",$s_id)->first();
        $course = Course::where("id",$c_id)->first();
        $quiz = Quiz::where("id",$id)->get();
        $questions = QuizQuestion::where("quiz_id",$id)->get();
        return view('teachers/quiz-form', ['user' => $user,
                                    'session' =>  $session,
                                    'course' => $course,
                                    'questions' => $questions,
                                    'value'=>$quiz,
                                    's_id'=>$s_id]);
    }

    public function updateByTeacher(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'title' => 'required',
            'closed_time'=>'required',
            'session' => 'required'
        ]);

        $id = DB::table('quiz')->where('id', $request->input('q_id'))
            ->update(
            [
                'session_id' => $request->input('session'), 
                'title' => $request->input('title'),            
                'closed_time' => $request->input('closed_time')
            ]
        );
        Flash::flash('flash_message', 'A quiz successfully updated!');
        return redirect('/quiz/manage-on-course/'.$request->input('q_id').'/'.$request->input('session').'/'.$request->input('c_id'));
    }

    public function addEssayQuestion($q_id, $s_id, $c_id)
    {
        $user = Auth::user();
        $quiz = Quiz::where("id",$q_id)->first();
        return view('teachers/quiz-essay-form', ['user' => $user,
                                    'quiz'=>$quiz,
                                    's_id'=>$s_id,
                                    'c_id'=>$c_id,
                                    'q_id'=>$q_id]);   
    }

    public function storeEssayQuestion(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'q_id' => 'required',
            'question'=>'required',
            'answer'=>'required',
            'is_essay' => 'required'
        ]);

        $id = DB::table('quiz_questions')->insertGetId(
            [
                'quiz_id' => $request->input('q_id'),
                'question' => $request->input('question'),
                'answer' => $request->input('answer'),
                'is_essay' => 1
            ]
        );
        Flash::flash('flash_message', 'An essay question successfully added!');
        return redirect('/quiz/manage-on-course/'.$request->input('q_id').'/'.$request->input('s_id').'/'.$request->input('c_id'));
    }


    public function addMultiplechoiceQuestion($q_id, $s_id, $c_id)
    {
        $user = Auth::user();
        $quiz = Quiz::where("id",$q_id)->first();
        return view('teachers/quiz-multiplechoice-form', ['user' => $user,
                                    'quiz'=>$quiz,
                                    's_id'=>$s_id,
                                    'c_id'=>$c_id,
                                    'q_id'=>$q_id]);   
    }

    public function editMultiplechoiceQuestion($id, $q_id, $s_id, $c_id)
    {
        $user = Auth::user();
        $quiz = Quiz::where("id",$q_id)->first();
        $question = QuizQuestion::where("id",$id)->get();
        return view('teachers/quiz-multiplechoice-form', ['user' => $user,
                                    'quiz'=>$quiz,
                                    'value'=>$question,
                                    's_id'=>$s_id,
                                    'c_id'=>$c_id,
                                    'q_id'=>$q_id]);   
    }

    public function storeMultiplechoiceQuestion(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'q_id' => 'required',
            'question'=>'required',
            'answer1'=>'required',
            'answer2'=>'required',
            'answer3'=>'required',
            'answer4'=>'required',
            'is_essay' => 'required'
        ]);
        $id = DB::table('quiz_questions')->insertGetId(
            [
                'quiz_id' => $request->input('q_id'),
                'question' => $request->input('question'),
                'answer' => $request->input('answer'),
                'is_essay' => 0
            ]
        );
        DB::table('quiz_multiplechoiches')->insertGetId(
             [
                'quiz_question_id' => $id,
                'answer1' => $request->input('answer1'),
                'answer2' => $request->input('answer2'),
                'answer3' => $request->input('answer3'),
                'answer4' => $request->input('answer4')
            ]
        );
        Flash::flash('flash_message', 'An multiplechoice question successfully added!');
        return redirect('/quiz/manage-on-course/'.$request->input('q_id').'/'.$request->input('s_id').'/'.$request->input('c_id'));
    }


    //menghapus kursus untuk teacher owner kursus
    public function deleteQuestion($id)
    {
        DB::table('quiz_questions')->where('id', '=', $id)->delete();
        Flash::flash('flash_message', 'A question successfully deleted!');
        return redirect()->back();
    }


}