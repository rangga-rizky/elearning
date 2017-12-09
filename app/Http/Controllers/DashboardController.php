<?php

namespace App\Http\Controllers;
use Auth;
use App\Course;
use Illuminate\Http\Request;

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
    	return view('teacher_dashboard', ['user' => $user]);
    }
}
