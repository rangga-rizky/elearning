<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Session;
use App\Course;
use Auth;
use DB;
use Session as Flash;

class SessionController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    // Menampilkan laman pembuatan session untuk sebuah course
    public function create()
    {
        $user = Auth::user();   

        $courses = DB::table('courses')
            ->select('courses.id as c_id', 'title as c_title', 'user_id', 'description', 'course_categories.name')
            ->join('course_categories', 'course_categories.id', '=', 'courses.course_category_id')
            ->join('users', 'users.id', '=', 'courses.user_id')
            ->where('users.username','=', $user['username'])
            ->get();
        // $arr = $this->get_data_create($user['username']);
        return view('teachers/sessions-form', ['user'=>$user,'courses' => $courses]);
    }

      // Menampilkan laman pembuatan session untuk sebuah course
    public function createByCourseId($c_id)
    {
        $user = Auth::user();   

        $courses = DB::table('courses')
            ->select('courses.id as c_id', 'title as c_title', 'user_id', 'description', 'course_categories.name')
            ->join('course_categories', 'course_categories.id', '=', 'courses.course_category_id')
            ->join('users', 'users.id', '=', 'courses.user_id')
            ->where('users.username','=', $user['username'])
            ->get();
        // $arr = $this->get_data_create($user['username']);
        return view('teachers/sessions-form', ['user'=>$user,'courses' => $courses, 'course_id'=>$c_id]);
    }
    

   // menampilkan semua sesi milik kursus seorang owner 
    public function indexByAuthor(){
    	$user = Auth::user();
    	$arr = $this->get_data_view( $user['username']);
		        $c_id='false';
		return view('teachers/sessions', ['sessions' => $arr[0], 'courses'=>$arr[1] ,'c_id'=>$c_id ,'user' => $user]);
    }

    //menampilkan semua sesi milik kursus seorang owner berdasarkan id kursus
   	public function showByCourse($c_id='')
    {
    	$user = Auth::user();
        $arr = $this->get_data_view( $user['username'] , $c_id);
        		$c_id=$c_id;
    	return view('teachers/sessions', ['sessions' => $arr[0], 'courses'=>$arr[1] ,'c_id'=>$c_id ,'user' => $user]);
    }

    //hapus sesi
    public function delete_teacher($s_id, $cid)
    {
        DB::table('sessions')->where('id', '=', $s_id)->delete();
        Flash::flash('flash_message', 'A session successfully deleted!');
        return redirect('/courses/manage/'.$cid);;
        // return redirect('/sessions/teacher')->back();
    }

      // Laman edit judul, deskripsi, dan course dari sebuah session yg sudah dibuat
    public function edit_teacher($id)
    {
        $user = Auth::user();
        $sessions = DB::table('sessions')
                    ->select('sessions.id as s_id', 'sessions.title as s_title', 'courses.title as c_title', 'user_id', 'sessions.description', 'courses.id as c_id' )
                    ->join('courses', 'courses.id', '=', 'sessions.course_id')
                    ->where('sessions.id', '=', $id)
                    ->get();
        
        $courses = DB::table('courses')
            ->select('courses.id as c_id', 'title as c_title', 'user_id', 'description', 'course_categories.name')
            ->join('course_categories', 'course_categories.id', '=', 'courses.course_category_id')
            ->join('users', 'users.id', '=', 'courses.user_id')
            ->where('users.username','=', $user['username'])
            ->get();
        // return view('teachers/courses', );
        return view('teachers/sessions-form',['value' => $sessions, 'courses'=>$courses ,'user'=>$user ]);
    }

       // Hasil submit for pembuatan session
    public function store_teacher(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'title' => 'required',
            'course'=>'required',
            'description' => 'required'//,
            // 'description' => 'required'
        ]);
        Flash::flash('flash_message', 'A course successfully added!');

        $id = DB::table('sessions')->insertGetId(
            [
                'course_id' => $request->input('course'), 
                'title' => $request->input('title'),
                'description' => $request->input('description')
            ]
        );
        // return redirect()->back();
        // return redirect()->route('/sessions/teacher');
        // return redirect('/sessions/teacher');;
        return redirect('/courses/manage/'.$request->input('course'));;

        // return view('teachers/lessons_create');
    }

    
    // Hasil submit form edit dikirim ke method ini
    public function update_teacher(Request $request)
    {

        $user = Auth::user();
        $this->validate($request, [
            'title' => 'required',
            'course'=>'required',
            'description' => 'required'//,
            // 'description' => 'required'
        ]);
        DB::table('sessions')->where('id',$request->input('s_id'))
                    ->update([
                                'title' => $request->input('title'),
                                'course_id'=> $request->input('course'),
                                'description'=> $request->input('description')
                        ]);
        Flash::flash('flash_message', 'A session updated successfully');
        return redirect('/courses/manage/'.$request->input('course'));;
        // return redirect('/sessions/teachers');
    }



    //query session
    public function get_data_view($username='', $c_id='')
 	{
 		switch ($username) {
 			case '':	
 			// Admin
    			$sessions = DB::table('sessions')
                    ->select('sessions.id as s_id', 'sessions.title', 'sessions.description', 'courses.title as c_title','course_categories.name', 'courses.user_id')
                    ->join('courses', 'courses.id', '=', 'sessions.course_id')
                    ->join('users', 'users.id', '=', 'courses.user_id')
                    ->join('course_categories', 'course_categories.id', '=', 'courses.course_category_id')
                    ->where('courses.id','=', $c_id);
                $courses = DB::table('courses')
                    ->select('courses.id as c_id', 'title', 'user_id', 'description', 'course_categories.name')
                    ->join('course_categories', 'course_categories.id', '=', 'courses.course_category_id')
                    ->join('users', 'users.id', '=', 'courses.user_id')
                    // ->where('users.username','=', $username)
                    ->get();
 				break;
 			
 			default:  
 			// Teacher
    			$sessions = DB::table('sessions')
                    ->select('sessions.id as s_id', 'sessions.title', 'sessions.description', 'courses.title as c_title', 'course_categories.name', 'courses.user_id')
                    ->join('courses', 'courses.id', '=', 'sessions.course_id')
                    ->join('users', 'users.id', '=', 'courses.user_id')
                    ->join('course_categories', 'course_categories.id', '=', 'courses.course_category_id')
                    ->where('users.username','=', $username);

                $courses = DB::table('courses')
                    ->select('courses.id as c_id', 'title', 'user_id', 'description', 'course_categories.name')
                    ->join('course_categories', 'course_categories.id', '=', 'courses.course_category_id')
                    ->join('users', 'users.id', '=', 'courses.user_id')
                    ->where('users.username','=', $username)
                    ->get();
                    // ->get();
 				break;
 		}
 		switch ($c_id) {
 			case '':
 				break;
 			default:
 				$sessions->where('courses.id','=', $c_id);
 				break;
 		}

		// $cc = DB::table('course_categories')->get();
 		return [$sessions->get(), $courses];
 	}
}
