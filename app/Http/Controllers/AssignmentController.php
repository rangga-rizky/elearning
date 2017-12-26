<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assingment;
use App\Session;
use App\Course;
use App\StudentAssingment;
use Auth;
use DB;

use Session as Flash;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function showbyUser($assignment_id){
    	$user = Auth::user();
    	$assignment = Assingment::where("id",$assignment_id)->first();
    	$studentAssingment = StudentAssingment::where("user_id",$user->id)->where("assignment_id",$assignment_id)->first();

        $dt = Carbon::parse($assignment['closed_time']);
        $assignment["remaining"] = $dt->diffForHumans(Carbon::now());
        $assignment['closed_time'] = $dt->formatLocalized('%A %d %B %Y');
        if(!empty($studentAssingment)){
            $dtUpdatedAt = Carbon::parse($studentAssingment['updated_at']);
            $studentAssingment['last_updated'] =  $dtUpdatedAt->formatLocalized('%A %d %B %Y');
        }
        
        return view('student/assignment', ['user' => $user,
                                    'assignment' =>  $assignment ,
                                    'studentAssingment' => $studentAssingment]);

    }

    public function createBySessionId($sess_id, $course_id)
    {
        $user = Auth::user();
        $session = Session::where("id",$sess_id)->first();
        $course = Course::where("id",$course_id)->first();
        return view('teachers/assignments-form', ['user' => $user,
                                    'session' =>  $session ,
                                    'course' => $course,
                                    's_id'=>$sess_id]);
    }

    public function storeBySessionId(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'title' => 'required',
            'description'=>'required',
            'closed_time'=>'required',
            'session' => 'required'//,
            // 'description' => 'required'
        ]);

        $id = DB::table('assingments')->insertGetId(
            [
                'session_id' => $request->input('session'), 
                'title' => $request->input('title'),
                'created_time' =>date('Y-m-d h:i:s'),
                'description' =>$request->input('description'),
                'closed_time' => $request->input('closed_time')
            ]
        );
        Flash::flash('flash_message', 'An assignment successfully added!');
        return redirect('/courses/manage/'.$request->input('c_id'));;

    }

    public function editByTeacher($id, $s_id, $c_id)
    {
        $user = Auth::user();
        $session = Session::where("id",$s_id)->first();
        $course = Course::where("id",$c_id)->first();
        $assignment = Assingment::where("id",$id)->get();
        return view('teachers/assignments-form', ['user' => $user,
                                    'session' =>  $session ,
                                    'course' => $course,
                                    'value'=>$assignment,
                                    's_id'=>$s_id]);
    }

    public function updateByTeacher(Request $request)
    {
        $user = Auth::user();
        $this->validate($request, [
            'title' => 'required',
            'description'=>'required',
            'closed_time'=>'required',
            'session' => 'required'
        ]);

        $id = DB::table('assingments')->where('id', $request->input('a_id'))
            ->update(
            [
                'session_id' => $request->input('session'), 
                'title' => $request->input('title'),                
                'description' =>$request->input('description'),
                'closed_time' => $request->input('closed_time')
            ]
        );
        Flash::flash('flash_message', 'An assignment successfully updated!');
        return redirect('/courses/manage/'.$request->input('c_id'));;
    }
}
