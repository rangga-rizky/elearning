<?php

namespace App\Http\Controllers;
use Auth;
use App\Course;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        if($user["role_id"] == 1 ){
            return $this->student($user);
        }else{
            return $this->teacher($user);
        }
    }

    private function student($user){
        $courses = Course::enrolled($user->id);
		return view('student_dashboard', ['user' => $user,'courses' =>  $courses]);
    }

    private function teacher($user){
        $user = Auth::user();
        $courses = DB::table('courses')
                    ->select('courses.id as c_id', 'title', 'user_id', 'description', 'course_categories.name')
                    ->join('course_categories', 'course_categories.id', '=', 'courses.course_category_id')
                    ->join('users', 'users.id', '=', 'courses.user_id')
                    ->where('users.username','=', $user['username'])
                    ->get();
        $cc = DB::table('course_categories')->get();
        return view('teachers/courses', ['courses' => $courses,
                                         'course_cat'=>$cc,
                                        'user' =>$user]);
    }
}
