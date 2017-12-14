<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class SessionController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
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
