<?php

namespace App\Http\Controllers;
use Auth;
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
            return $this->student();
        }else{
            return $this->teacher();
        }
    }

    private function student(){
		return view('student_dashboard');
    }

    private function teacher(){
    	return view('teacher_dashboard');
    }
}
