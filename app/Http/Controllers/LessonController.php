<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Lesson;
use App\Course;

use Session as Flash;

use DB;
use Auth;

class LessonController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function createBySessionId($s_id,$c_id)
    {
        $user = Auth::user();
        // $session = DB::table('sessions')->get();
        $session = Session::where("id",$s_id)->first();
        $course = Course::where("id",$c_id)->first();
        // $session = new Session();
		return view('teachers/lessons-form', ['user' => $user,
									'session'=>$session,
									'course'=>$course,
									's_id'=>$s_id]);
    }

    public function storeBySessionId(Request $request)
    {
    	$user = Auth::user();
        $this->validate($request, [
            'text' => 'required',
            'fileupload'=>'required',
            's_id'=>'required',
            'modul_type' => 'required'//,
            // 'description' => 'required'
        ]);

    	$file = $request->file('fileupload');
		$filename = $user->id."_".$request->input('s_id')."_".uniqid().".".$file->getClientOriginalExtension();
    		$destinationPath = 'files/lessons';
      		$file->move($destinationPath,$filename);

        $id = DB::table('lessons')->insertGetId(
            [
                'session_id' => $request->input('s_id'), 
                'text' => $request->input('text'),
                'filepath' => 'files/lessons/'.$filename,
                'modul_type' => $request->input('modul_type')
            ]
        );
        Flash::flash('flash_message', 'A lesson successfully added!');
        return redirect('/courses/manage/'.$request->input('c_id'));
    }


    //menghapus kursus untuk teacher owner kursus
    public function deleteByTeacher($id)
    {
        DB::table('lessons')->where('id', '=', $id)->delete();
        Flash::flash('flash_message', 'A lesson successfully deleted!');
        return redirect()->back();
     
    }

    public function editByTeacher($id, $s_id,$c_id)
    {
        $user = Auth::user();
        // $session = DB::table('sessions')->get();
        $lesson = Lesson::where("id",$id)->get();
        $session = Session::where("id",$s_id)->first();
        $course = Course::where("id",$c_id)->first();
        // $session = new Session();
        return view('teachers/lessons-form', ['user' => $user,
                                    'session'=>$session,
                                    'course'=>$course,
                                    'value'=>$lesson,
                                    's_id'=>$s_id]);
    }
    
    public function updateByTeacher(Request $request)
    {
    	# code...
    }
    

}
